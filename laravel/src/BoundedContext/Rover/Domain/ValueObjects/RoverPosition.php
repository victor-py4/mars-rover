<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Domain\ValueObjects;

    use DateTime;

    final class RoverPosition
    {
        /**
         * @var array
         */
        private $value;

        public function __construct(array $position)
        {
            $this->value = $position;
        }

        public function value(): array
        {
            return $this->value;
        }
    }
