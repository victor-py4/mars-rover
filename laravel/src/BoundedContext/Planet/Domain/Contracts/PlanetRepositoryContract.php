<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Domain\Contracts;

    use Src\BoundedContext\Planet\Domain\Planet;
    use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetId;

    interface PlanetRepositoryContract
    {
        public function find(PlanetId $id): ?Planet;

        public function save(Planet $planet): void;

        public function update(PlanetId $id, Planet $planet): void;

        public function delete(PlanetId $id): void;
    }