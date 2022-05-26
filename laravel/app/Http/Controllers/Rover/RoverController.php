<?php

    declare(strict_types=1);

    namespace App\Http\Controllers\Rover;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Src\BoundedContext\Rover\Infrastructure\CreateRoverController;
    use Src\BoundedContext\Rover\Infrastructure\DeleteRoverController;
    use Src\BoundedContext\Rover\Infrastructure\GetRoverController;
    use Src\BoundedContext\Rover\Infrastructure\UpdateRoverController;

    /**
     * Class RoverController
     *
     * @package \App\Http\Controllers
     */
    class RoverController extends Controller {

        private $createRoverController;
        private $deleteRoverController;
        private $getRoverController;
        private $updateRoverController;

        public function __construct(
            CreateRoverController $createRoverController,
            DeleteRoverController $deleteRoverController,
            GetRoverController $getRoverController,
            UpdateRoverController $updateRoverController
        ) {
            $this->createRoverController = $createRoverController;
            $this->deleteRoverController = $deleteRoverController;
            $this->getRoverController = $getRoverController;
            $this->updateRoverController = $updateRoverController;
        }

        public function createRover(Request $request) : Response {

            $rover = $this->createRoverController->__invoke($request);

            return response($rover, 201);
        }

        public function deleteRover(Request $request) {
            $this->deleteRoverController->__invoke($request);

            return response([], 201);
        }

        public function getRover(Request $request, $id) {
            $getRover = $this->getRoverController->__invoke($request, $id);

            return response($getRover, 201);
        }

        public function updateRover(Request $request) {

            $updateRover = $this->updateRoverController->__invoke($request);

            return response()->json($updateRover, 201);
        }

        public function getRoverByName(Request $request, $name) {

            $getRover = $this->getRoverController->getByName($name);

            return response()->json($getRover, 201);
        }

        public function sendInstructions(Request $request) {

            $updateRover = $this->updateRoverController->sendInstructions($request);

            return response()->json($updateRover["data"], $updateRover["code"]);
        }

    }

