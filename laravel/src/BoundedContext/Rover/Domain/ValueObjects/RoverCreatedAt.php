<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Domain\ValueObjects;

    use DateTime;

    final class RoverCreatedAt
    {
        /**
         * @var Datetime
         */
        private $value;

        public function __construct(DateTime $created_at)
        {
            $this->value = $created_at;
        }

        public function value(): DateTime
        {
            return $this->value;
        }
    }
