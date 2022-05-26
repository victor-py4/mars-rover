<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Domain\ValueObjects;

    use DateTime;

    final class RoverInstructions
    {
        /**
         * @var array
         */
        private $value;

        public function __construct(array $instructions)
        {
            $this->value = $instructions;
        }

        public function value(): array
        {
            return $this->value;
        }
    }
