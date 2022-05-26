<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Application;

    use DateTime;
    use Src\BoundedContext\Planet\Domain\Contracts\PlanetRepositoryContract;
    use Src\BoundedContext\Planet\Domain\Planet;

    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetBoundingBox;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetCreatedAt;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetId;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetObstacles;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetUpdatedAt;


    final class UpdatePlanetUseCase {

        /**
         * @var \Src\BoundedContext\Planet\Domain\Contracts\PlanetRepositoryContract
         */
        private $repository;

        public function __construct(PlanetRepositoryContract $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(
            array $planetBoundingBox,
            ?DateTime $planetCreatedAt,
            int $planetId,
            array $planetObstacles,
            ?DateTime $planetUpdatedAt,
        ) :void
        {
            $boundingBox = new PlanetBoundingBox($planetBoundingBox);
            $createdAt = new PlanetCreatedAt($planetCreatedAt);
            $id = new PlanetId($planetId);
            $obstacles = new PlanetObstacles($planetObstacles);
            $updatedAt = new PlanetUpdatedAt($planetUpdatedAt);

            $planet = Planet::create(
            $boundingBox,
            $createdAt,
            $obstacles,
            $updatedAt,
        );

        $this->repository->update($id, $planet);
        }
    }
