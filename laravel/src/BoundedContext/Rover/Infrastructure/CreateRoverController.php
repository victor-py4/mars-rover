<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Rover\Application\CreateRoverUseCase;
    use Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;
    

    final class CreateRoverController
    {
        /**
         * @var \Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;
         */
        private $repository;

        public function __construct(EloquentRoverRepository $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(Request $request) {
            $roverCreatedAt = $request->input( 'created_at')?: null;

            $createRoverUseCase = new CreateRoverUseCase($this->repository);

            $createRoverUseCase->__invoke(

            );

            return $createRoverUseCase;
        }
    }