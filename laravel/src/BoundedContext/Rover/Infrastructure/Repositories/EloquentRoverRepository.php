<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Infrastructure\Repositories;

    use App\Models\Rover as EloquentRoverModel;
    use Src\BoundedContext\Rover\Domain\Rover;
    use Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverCreatedAt;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverId;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverInstructions;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverName;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverPosition;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverReports;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverUpdatedAt;


    final class EloquentRoverRepository implements RoverRepositoryContract
    {
        /**
         * @var \App\Models\Rover
         */
        private $eloquentRoverModel;

        public function __construct()
        {
            $this->eloquentRoverModel = new EloquentRoverModel;
        }

        public function find(RoverId $id): ?Rover
        {
            $rover = $this->eloquentRoverModel->findOrFail($id->value());

            return new Rover (
               new RoverCreatedAt($rover->created_at),
               new RoverInstructions($rover->instructions),
               new RoverName($rover->name),
               new RoverPosition($rover->position),
               new RoverReports($rover->reports),
               new RoverUpdatedAt($rover->updated_at),
               new RoverId($rover->id),
            );
        }

        public function save(Rover $rover): void
        {
            $newRover = $this->eloquentRoverModel;

            $data = [
               'created_at' => $rover->created_at()->value(),
               'instructions' => $rover->instructions()->value(),
               'name' => $rover->name()->value(),
               'position' => $rover->position()->value(),
               'reports' => $rover->reports()->value(),
               'updated_at' => $rover->updated_at()->value(),
            ];

            $newRover->create($data);
        }

        public function update(RoverId $id, Rover $rover): void
        {
            $newRover = $this->eloquentRoverModel;

            $data = [
               'created_at' => $rover->created_at()->value(),
               'instructions' => $rover->instructions()->value(),
               'name' => $rover->name()->value(),
               'position' => $rover->position()->value(),
               'reports' => $rover->reports()->value(),
               'updated_at' => $rover->updated_at()->value(),
            ];

            $newRover->findOrfail($id->value())->update($data);
        }

        public function delete(RoverId $id): void
        {
            $newRover = $this->eloquentRoverModel;

            $newRover->findOrfail($id->value())->detele();
        }

        public function findByName(RoverName $name): ?Rover
        {
            $rover = $this->eloquentRoverModel->where('name', $name->value())->first();

            return new Rover (
               new RoverCreatedAt($rover->created_at),
               new RoverInstructions($rover->instructions),
               new RoverName($rover->name),
               new RoverPosition($rover->position),
               new RoverReports($rover->reports),
               new RoverUpdatedAt($rover->updated_at),
               new RoverId($rover->id),
            );
        }
    }
