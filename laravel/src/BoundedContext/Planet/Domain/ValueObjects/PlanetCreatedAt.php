<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Domain\ValueObjects;

    use DateTime;

    final class PlanetCreatedAt
    {
        /**
         * @var Datetime
         */
        private $value;

        public function __construct(Datetime $created_at)
        {
            $this->value = $created_at;
        }

        public function value(): Datetime
        {
            return $this->value;
        }
    }
