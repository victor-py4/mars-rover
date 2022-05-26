<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Domain\ValueObjects;

    use DateTime;

    final class PlanetUpdatedAt
    {
        /**
         * @var Datetime
         */
        private $value;

        public function __construct(Datetime $updated_at)
        {
            $this->value = $updated_at;
        }

        public function value(): Datetime
        {
            return $this->value;
        }
    }
