<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Rover\Application\GetByNameRoverUseCase;
    use Src\BoundedContext\Rover\Application\GetRoverUseCase;
    use Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;


    final class GetRoverController
    {
        /**
         * @var \Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;
         */
        private $repository;

        public function __construct(EloquentRoverRepository $repository)
        {
            $this->repository = $repository;
        }

        /**
         * @param \Illuminate\Http\Request $request
         *
         * @return \Src\BoundedContext\Rover\Domain\Rover|null
         */
        public function __invoke(Request $request, $id) {

            $roverId = (int)$id;
            $roverUseCase = new GetRoverUseCase($this->repository);
            $rover = $roverUseCase->__invoke($roverId);

            return $rover;
        }

        /**
         * @param $name
         *
         * @return \Src\BoundedContext\Rover\Domain\Rover|null
         */
        public function getByName($name) {

            $roverUseCase = new GetByNameRoverUseCase($this->repository);
            $rover = $roverUseCase->__invoke($name);

            return $rover;
        }
    }
