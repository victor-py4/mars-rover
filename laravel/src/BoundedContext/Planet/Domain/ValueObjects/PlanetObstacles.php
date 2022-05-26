<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Domain\ValueObjects;

    use DateTime;

    final class PlanetObstacles
    {
        /**
         * @var array
         */
        private $value;

        public function __construct(array $obstacles)
        {
            $this->value = $obstacles;
        }

        public function value(): array
        {
            return $this->value;
        }
    }
