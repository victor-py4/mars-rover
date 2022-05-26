<?php

declare(strict_types=1);

namespace Src\BoundedContext\Rover\Domain;

use Src\BoundedContext\Rover\Domain\ValueObjects\RoverCreatedAt;
use Src\BoundedContext\Rover\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Rover\Domain\ValueObjects\RoverInstructions;
use Src\BoundedContext\Rover\Domain\ValueObjects\RoverName;
use Src\BoundedContext\Rover\Domain\ValueObjects\RoverPosition;
use Src\BoundedContext\Rover\Domain\ValueObjects\RoverReports;
use Src\BoundedContext\Rover\Domain\ValueObjects\RoverUpdatedAt;
use JsonSerializable;

final class Rover implements JsonSerializable
{

    private $created_at;
    private $instructions;
    private $name;
    private $position;
    private $reports;
    private $updated_at;
    private $id;

    public function __construct(

        RoverCreatedAt $created_at,
        RoverInstructions $instructions,
        RoverName $name,
        RoverPosition $position,
        RoverReports $reports,
        RoverUpdatedAt $updated_at,
        RoverId| null $id = null
    )
    {

        $this->created_at = $created_at;
        $this->instructions = $instructions;
        $this->name = $name;
        $this->position = $position;
        $this->reports = $reports;
        $this->updated_at = $updated_at;
        $this->id = $id;
    }

    public function created_at(): RoverCreatedAt
    {
        return $this->created_at;
    }

    public function instructions(): RoverInstructions
    {
        return $this->instructions;
    }

    public function name(): RoverName
    {
        return $this->name;
    }

    public function position(): RoverPosition
    {
        return $this->position;
    }

    public function reports(): RoverReports
    {
        return $this->reports;
    }

    public function updated_at(): RoverUpdatedAt
    {
        return $this->updated_at;
    }

    public function id(): RoverId
    {
        return $this->id;
    }

    public static function create(
        RoverCreatedAt $created_at,
        RoverInstructions $instructions,
        RoverName $name,
        RoverPosition $position,
        RoverReports $reports,
        RoverUpdatedAt $updated_at,
        RoverId| null $id = null

    ): Rover
    {

        $rover = new self(
            $created_at,
            $instructions,
            $name,
            $position,
            $reports,
            $updated_at,
            $id
        );

        return $rover;
    }

    public function __serialize(): array
    {
        return [
            "created_at" => $this->created_at()->value(),
            "instructions" => $this->instructions()->value(),
            "name" => $this->name()->value(),
            "position" => $this->position()->value(),
            "reports" => $this->reports()->value(),
            "updated_at" => $this->updated_at()->value(),
            "id" => $this->id()->value(),
        ];
    }

    public function jsonSerialize()
    {
        return $this->__serialize();
    }
}
