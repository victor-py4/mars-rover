<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Domain\ValueObjects;

    use DateTime;

    final class PlanetBoundingBox
    {
        /**
         * @var \stdClass
         */
        private $value;

        public function __construct(\stdClass $bounding_box)
        {
            $this->value = $bounding_box;
        }

        public function value(): \stdClass
        {
            return $this->value;
        }
    }
