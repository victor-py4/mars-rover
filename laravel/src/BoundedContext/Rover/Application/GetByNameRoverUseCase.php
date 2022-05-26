<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Application;

    use Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract;
    use Src\BoundedContext\Rover\Domain\Rover;


    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverId;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverName;

    final class GetByNameRoverUseCase {

        /**
         * @var \Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract
         */
        private $repository;

        public function __construct(RoverRepositoryContract $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(
            string $roverName,

        ): ?Rover
        {
            $name = new RoverName($roverName);

            return $this->repository->findByName($name);

        }
    }
