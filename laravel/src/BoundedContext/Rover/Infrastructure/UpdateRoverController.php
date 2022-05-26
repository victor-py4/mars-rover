<?php

declare(strict_types=1);

namespace Src\BoundedContext\Rover\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Planet\Application\GetPlanetUseCase;
use Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;
use Src\BoundedContext\Rover\Application\GetByNameRoverUseCase;
use Src\BoundedContext\Rover\Application\GetRoverUseCase;
use Src\BoundedContext\Rover\Application\UpdateRoverUseCase;
use Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;


final class UpdateRoverController
{
    /**
     * @var \Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;
     */
    private $repository;
    /**
     * @var
     */
    private $planetRepository;

    public function __construct(EloquentRoverRepository $repository, EloquentPlanetRepository $planet_repository)
    {
        $this->repository = $repository;
        $this->planetRepository = $planet_repository;
    }

    public function __invoke(Request $request)
    {

        $roverId = $request->input('id');
        $roverUseCase = new GetRoverUseCase($this->repository);
        $rover = $roverUseCase->__invoke($roverId);

        $roverCreatedAt = $request->input('created_at') ?? $rover->created_at()->value();
        $roverInstructions = $request->input('instructions') ?? $rover->instructions()->value();
        $roverName = $request->input('name') ?? $rover->name()->value();
        $roverPosition = $request->input('position') ?? $rover->position()->value();
        $roverReports = $request->input('reports') ?? $rover->reports()->value();
        $roverUpdatedAt = $request->input('updated_at') ?? $rover->updated_at()->value();


        $createRoverUseCase = new UpdateRoverUseCase($this->repository);

        $createRoverUseCase->__invoke(
            $roverCreatedAt,
            $roverId,
            $roverInstructions,
            $roverName,
            $roverPosition,
            $roverReports, $roverUpdatedAt,


        );
        $updatedRover = $roverUseCase->__invoke($roverId);
        return $updatedRover;
    }

    public function sendInstructions(Request $request) {

        $roverId = (int)$request->input('id');
        $planetId = (int)$request->input('planet_id');
        $instructions = $request->input('instructions');

        $roverUseCase = new GetRoverUseCase($this->repository);
        $rover = $roverUseCase->__invoke($roverId);

        $planetUseCase = new GetPlanetUseCase($this->planetRepository);
        $planet = $planetUseCase->__invoke($planetId);


        $updatedRoverUseCase = new UpdateRoverUseCase($this->repository);
        $newPosition = $updatedRoverUseCase->updatePosition($rover, $planet, $instructions);

        return $newPosition;
    }
}
