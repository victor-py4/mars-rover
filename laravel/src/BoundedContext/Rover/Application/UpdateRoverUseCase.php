<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Application;

    use Carbon\Carbon;
    use DateTime;
    use Exception;
    use Src\BoundedContext\Planet\Domain\Planet;
    use Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract;
    use Src\BoundedContext\Rover\Domain\Rover;

    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverCreatedAt;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverId;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverInstructions;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverName;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverPosition;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverReports;
    use Src\BoundedContext\Rover\Domain\ValueObjects\RoverUpdatedAt;


    final class UpdateRoverUseCase {

        /**
         * @var \Src\BoundedContext\Rover\Domain\Contracts\RoverRepositoryContract
         */
        private $repository;

        public function __construct(RoverRepositoryContract $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(
            ?DateTime $roverCreatedAt,
            int $roverId,
            array $roverInstructions,
            string $roverName,
            array $roverPosition,
            array $roverReports,
            ?DateTime $roverUpdatedAt,
        ) :void
        {
            $createdAt = new RoverCreatedAt($roverCreatedAt);
            $id = new RoverId($roverId);
            $instructions = new RoverInstructions($roverInstructions);
            $name = new RoverName($roverName);
            $position = new RoverPosition($roverPosition);
            $reports = new RoverReports($roverReports);
            $updatedAt = new RoverUpdatedAt($roverUpdatedAt);

            $rover = Rover::create(
                $createdAt,
                $instructions,
                $name,
                $position,
                $reports,
                $updatedAt,
                $id,
            );

            $this->repository->update($id, $rover);
        }

        /**
         * @param $boundingBox
         * @param $position
         * @param $coordinate
         * @param $axis
         * @param $obstacles
         *
         * @return mixed
         */
        private function processInstructions($boundingBox, $position, $coordinate, $axis, $obstacles) {

            $newPosition = $position[$axis] + $coordinate;
            $opositeAxis = 'x';

            if($axis === $opositeAxis) {
                $opositeAxis = 'y';
            }

            if($newPosition > 0 && $newPosition < $boundingBox[$axis]) {

                foreach ($obstacles as $obstacle) {
                    if(!($obstacle->$axis === $newPosition && $position[$opositeAxis] === $obstacle->$opositeAxis)) {
                        $position[$axis] = $newPosition;

                        return [
                            "status" => "Success",
                            "position" => $position
                        ];

                    } else {
                        return [
                            "status" => "Failed",
                            "message" => "An obstacle found in path ${axis}: ${newPosition}, ${opositeAxis}: ${position[$opositeAxis]} , moving to the last secure position",
                            "position" => $position,
                            "obstacle" => [
                                $axis => $newPosition,
                                $opositeAxis => $position[$opositeAxis]
                            ]
                        ];
                    }
                }

            } else {
                return [
                    "status" => "Failed",
                    "message" => "Coordinates are out of bounds,  moving to the last secure position",
                    "position" => $position
                ];
            }
        }

        /**
         * @param \Src\BoundedContext\Rover\Domain\Rover   $rover
         * @param \Src\BoundedContext\Planet\Domain\Planet $planet
         * @param string                                   $instructions
         *
         * @return array
         * @throws \Exception
         */
        public function updatePosition(Rover $rover, Planet $planet, string $instructions) {

            $movements = [];

            $roverPosition = $rover->position()->value();
            $boundingBox = [
                "x" => $planet->bounding_box()->value()->x,
                "y" => $planet->bounding_box()->value()->y
            ];
            $obstacles = $planet->obstacles()->value();

            $createdAt = new RoverCreatedAt($rover->created_at()->value());
            $id = new RoverId($rover->id()->value());
            $roverInstructions = new RoverInstructions($rover->instructions()->value());
            $name = new RoverName($rover->name()->value());
            $position = new RoverPosition($roverPosition);
            $reports = new RoverReports($rover->reports()->value());
            $updatedAt = new RoverUpdatedAt(Carbon::now());

            for ($idx = 0; $idx < strlen($instructions); $idx++) {
                switch ($instructions[$idx]) {
                    case 'F':
                        $movements[] = [
                            "axis" => "y",
                            "value" => 1,
                        ];
                        break;

                    case 'L':
                        $movements[] = [
                            "axis" => "x",
                            "value" => -1,
                        ];
                        break;

                    case 'R':
                        $movements[] = [
                            "axis" => "x",
                            "value" => 1,
                        ];
                        break;
                }
            }

            foreach ($movements as $direction) {

                if($direction["axis"] === 'x' || $direction["axis"] === 'y') {
                    $roverResponse = $this->processInstructions($boundingBox, $roverPosition, $direction["value"], $direction["axis"], $obstacles);

                    if($roverResponse["status"] === "Failed") {
                        if(array_key_exists("obstacle", $roverResponse)) {
                            $newReports = $rover->reports()->value();
                            $newReports[] = $roverResponse["obstacle"];

                            $reports = new RoverReports($newReports);
                        }

                        $newRover = Rover::create(
                            $createdAt,
                            $roverInstructions,
                            $name,
                            $position,
                            $reports,
                            $updatedAt,
                            $id,
                        );

                        $this->repository->update($id, $newRover);

                        $updatedRover = $this->repository->find($id);

                        return [
                            "data" => $roverResponse,
                            "code" => 400,
                        ];
                    } else {

                        $roverPosition = $roverResponse["position"];

                        $position = new RoverPosition($roverPosition);

                        $newInstructions = $rover->instructions()->value();
                        $newInstructions[] = $roverPosition;

                        $roverInstructions = new RoverInstructions($newInstructions);
                    }

                } else {
                    return [
                        "data" => [
                            "status" => "Failed",
                            "message" => "This axis is incorrect, rover only moves in 2 dimensions"
                        ],
                        "code" => 400
                    ];
                }
            }



            $newRover = Rover::create(
                $createdAt,
                $roverInstructions,
                $name,
                $position,
                $reports,
                $updatedAt,
                $id,
            );

            $this->repository->update($id, $newRover);

            $updatedRover = $this->repository->find($id);

            return [
                "data" => [
                    "message" => "Rover is moving to the next position",
                    "position" => $roverPosition,
                    "rover" => $updatedRover
                ],
                "code" => 200
            ];

        }
    }
