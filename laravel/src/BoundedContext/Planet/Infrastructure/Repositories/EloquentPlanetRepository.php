<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Infrastructure\Repositories;

    use App\Models\Planet as EloquentPlanetModel;
    use Src\BoundedContext\Planet\Domain\Planet;
    use Src\BoundedContext\Planet\Domain\Contracts\PlanetRepositoryContract;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetBoundingBox;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetCreatedAt;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetId;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetObstacles;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetUpdatedAt;


    final class EloquentPlanetRepository implements PlanetRepositoryContract
    {
        /**
         * @var \App\Models\Planet
         */
        private $eloquentPlanetModel;

        public function __construct()
        {
            $this->eloquentPlanetModel = new EloquentPlanetModel;
        }

        public function find(PlanetId $id): ?Planet
        {
            $planet = $this->eloquentPlanetModel->findOrFail($id->value());

            return new Planet (
               new PlanetBoundingBox(json_decode($planet->bounding_box)),
               new PlanetCreatedAt($planet->created_at),
               new PlanetObstacles(json_decode($planet->obstacles)),
               new PlanetUpdatedAt($planet->updated_at),
            );
        }

        public function save(Planet $planet): void
        {
            $newPlanet = $this->eloquentPlanetModel;

            $data = [
               'bounding_box' => $planet->bounding_box()->value(),
               'created_at' => $planet->created_at()->value(),
               'obstacles' => $planet->obstacles()->value(),
               'updated_at' => $planet->updated_at()->value(),
            ];

            $newPlanet->create($data);
        }

        public function update(PlanetId $id, Planet $planet): void
        {
            $newPlanet = $this->eloquentPlanetModel;

            $data = [
               'bounding_box' => $planet->bounding_box()->value(),
               'created_at' => $planet->created_at()->value(),
               'obstacles' => $planet->obstacles()->value(),
               'updated_at' => $planet->updated_at()->value(),
            ];

            $newPlanet->findOrfail($id->value())->update($data);
        }

        public function delete(PlanetId $id): void
        {
            $newPlanet = $this->eloquentPlanetModel;

            $newPlanet->findOrfail($id->value())->detele();
        }
    }
