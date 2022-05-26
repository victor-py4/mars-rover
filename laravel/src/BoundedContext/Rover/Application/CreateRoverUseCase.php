<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Application;

    use DateTime;
    use Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract;
    use Src\BoundedContext\Rover\Domain\Rover;

    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverCreatedAt;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverInstructions;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverName;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverPosition;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverReports;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverUpdatedAt;


    final class CreateRoverUseCase {

        /**
         * @var \Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract
         */
        private $repository;

        public function __construct(RoverRepositoryContract $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(
            ?DateTime $roverCreatedAt,
            array $roverInstructions,
            string $roverName,
            array $roverPosition,
            array $roverReports,
            ?DateTime $roverUpdatedAt,

        ) :void
        {
            $createdAt = new RoverCreatedAt($roverCreatedAt);
            $instructions = new RoverInstructions($roverInstructions);
            $name = new RoverName($roverName);
            $position = new RoverPosition($roverPosition);
            $reports = new RoverReports($roverReports);
            $updatedAt = new RoverUpdatedAt($roverUpdatedAt);

            $rover = Rover::create(
            $createdAt,
            $instructions,
            $name,
            $position,
            $reports,
            $updatedAt,
        );

        $this->repository->save($rover);
        }
    }
