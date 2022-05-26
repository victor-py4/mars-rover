<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Domain\ValueObjects;

    use DateTime;

    final class RoverUpdatedAt
    {
        /**
         * @var Datetime
         */
        private $value;

        public function __construct(DateTime $updated_at)
        {
            $this->value = $updated_at;
        }

        public function value(): DateTime
        {
            return $this->value;
        }
    }
