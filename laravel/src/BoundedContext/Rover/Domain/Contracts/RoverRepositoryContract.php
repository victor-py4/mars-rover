<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Domain\Contracts;

    use Src\BoundedContext\Rover\Domain\Rover;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverId;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverName;

    interface RoverRepositoryContract
    {
        public function find(RoverId $id): ?Rover;

        public function findByName(RoverName $name): ?Rover;

        public function save(Rover $rover): void;

        public function update(RoverId $id, Rover $rover): void;

        public function delete(RoverId $id): void;
    }
