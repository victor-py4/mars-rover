<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Domain\ValueObjects;

    use DateTime;

    final class RoverReports
    {
        /**
         * @var array
         */
        private $value;

        public function __construct(array $reports)
        {
            $this->value = $reports;
        }

        public function value(): array
        {
            return $this->value;
        }
    }
