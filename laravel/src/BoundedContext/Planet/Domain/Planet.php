<?php

declare(strict_types=1);

namespace Src\BoundedContext\Planet\Domain;

use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetBoundingBox;
use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetCreatedAt;
use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetObstacles;
use Src\BoundedContext\Planet\Domain\ValueObjects\PlanetUpdatedAt;
use JsonSerializable;

final class Planet implements JsonSerializable
{

    private $bounding_box;
    private $created_at;
    private $obstacles;
    private $updated_at;

    public function __construct(

        PlanetBoundingBox $bounding_box,
        PlanetCreatedAt $created_at,
        PlanetObstacles $obstacles,
        PlanetUpdatedAt $updated_at,
    )
    {

        $this->bounding_box = $bounding_box;
        $this->created_at = $created_at;
        $this->obstacles = $obstacles;
        $this->updated_at = $updated_at;
    }

    public function bounding_box(): PlanetBoundingBox
    {
        return $this->bounding_box;
    }

    public function created_at(): PlanetCreatedAt
    {
        return $this->created_at;
    }

    public function obstacles(): PlanetObstacles
    {
        return $this->obstacles;
    }

    public function updated_at(): PlanetUpdatedAt
    {
        return $this->updated_at;
    }

    public static function create(
        PlanetBoundingBox $bounding_box,
        PlanetCreatedAt $created_at,
        PlanetObstacles $obstacles,
        PlanetUpdatedAt $updated_at,

    ): Planet
    {

        $planet = new self(
            $bounding_box,
            $created_at,
            $obstacles,
            $updated_at,
        );

        return $planet;
    }

    public function __serialize(): array
    {
        return [
            "created_at" => $this->created_at()->value(),
            "bounding_box" => $this->bounding_box()->value(),
            "obstacles" => $this->obstacles()->value(),
            "updated_at" => $this->updated_at()->value(),
        ];
    }

    public function jsonSerialize()
    {
        return $this->__serialize();
    }
}
