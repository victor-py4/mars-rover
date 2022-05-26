<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Application;

    use Src\BoundedContext\Planet\Domain\Contracts\PlanetRepositoryContract;
    use Src\BoundedContext\Planet\Domain\Planet;


    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetBoundingBox;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetId;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetObstacles;

    final class GetPlanetUseCase {

        /**
         * @var \Src\BoundedContext\Planet\Domain\Contracts\PlanetRepositoryContract
         */
        private $repository;

        public function __construct(PlanetRepositoryContract $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(
            int $planetId,

        ): ?Planet
        {
            $id = new PlanetId($planetId);

            return $this->repository->find($id);

        }

        public function getBoundingBox(PlanetBoundingBox $axis) {
            $planetAxis = $axis->value();
            $area = $planetAxis->x * $planetAxis->y;

            return $area;
        }
    }
