<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Application;

    use Src\BoundedContext\Planet\Domain\Contracts\PlanetRepositoryContract;
    use Src\BoundedContext\Planet\Domain\Planet;


    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetId;

    final class DeletePlanetUseCase {

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

            $this->repository->delete($id);

        }
    }
