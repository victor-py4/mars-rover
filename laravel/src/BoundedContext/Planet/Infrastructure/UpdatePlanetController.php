<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Planet\Application\GetPlanetUseCase;
    use Src\BoundedContext\Planet\Application\UpdatePlanetUseCase;
    use Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;
    

    final class UpdatePlanetController
    {
        /**
         * @var \Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;
         */
        private $repository;

        public function __construct(EloquentPlanetRepository $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(Request $request) {
        
           $planetId = $request->input('id');

            $planetBoundingBox = $request->input( 'bounding_box')?? $planet->bounding_box()->value();

            $createPlanetUseCase = new UpdatePlanetUseCase($this->repository);

            $createPlanetUseCase->__invoke(

            );$updatedPlanet = $planetUseCase->__invoke($planetId);
            return $updatedPlanet;
        }
    }