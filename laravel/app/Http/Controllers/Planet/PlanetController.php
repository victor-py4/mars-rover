<?php

    declare(strict_types=1);

    namespace App\Http\Controllers\Planet;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Routing\Controller;
    use Src\BoundedContext\Planet\Infrastructure\CreatePlanetController;
    use Src\BoundedContext\Planet\Infrastructure\DeletePlanetController;
    use Src\BoundedContext\Planet\Infrastructure\GetPlanetController;
    use Src\BoundedContext\Planet\Infrastructure\UpdatePlanetController;

    /**
     * Class PlanetController
     *
     * @package \App\Http\Controllers
     */
    class PlanetController extends Controller {

        private $createPlanetController;
        private $deletePlanetController;
        private $getPlanetController;
        private $updatePlanetController;

        public function __construct(
            CreatePlanetController $createPlanetController,
            DeletePlanetController $deletePlanetController,
            GetPlanetController $getPlanetController,
            UpdatePlanetController $updatePlanetController
        ) {
            $this->createPlanetController = $createPlanetController;
            $this->deletePlanetController = $deletePlanetController;
            $this->getPlanetController = $getPlanetController;
            $this->updatePlanetController = $updatePlanetController;
        }

        public function createPlanet(Request $request) : Response {

            $planet = $this->createPlanetController->__invoke($request);

            return response($planet, 201);
        }

        public function deletePlanet(Request $request) {
            $this->deletePlanetController->__invoke($request);

            return response([], 201);
        }

        public function getPlanet(Request $request) {
            $getPlanet = $this->getPlanetController->__invoke($request);

            return response($getPlanet, 201);
        }

        public function updatePlanet(Request $request) {
            $updatePlanet = $this->updatePlanetController->__invoke($request);

            return response($updatePlanet, 201);
        }

        public function getPlanetBoundingBox(Request $request) {
            $getPlanetBoundingBox = $this->getPlanetController->getBoundingBox($request);

            return response()->json($getPlanetBoundingBox, 201);
        }

    }

