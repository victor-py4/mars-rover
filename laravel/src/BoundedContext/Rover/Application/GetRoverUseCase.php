<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Application;

    use Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract;
    use Src\BoundedContext\Rover\Domain\Rover;


    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverId;

    final class GetRoverUseCase {

        /**
         * @var \Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract
         */
        private $repository;

        public function __construct(RoverRepositoryContract $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(
            int $roverId,

        ): ?Rover
        {
            $id = new RoverId($roverId);

            return $this->repository->find($id);

        }
    }
