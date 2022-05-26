<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Planet\Application\GetPlanetUseCase;
    use Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;


    final class GetPlanetController
    {
        /**
         * @var \Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;
         */
        private $repository;

        public function __construct(EloquentPlanetRepository $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(Request $request) {

            $planetId = $request->input('id');
            $planetUseCase = new GetPlanetUseCase($this->repository);
            $planet = $planetUseCase->__invoke($planetId);

            return $planet;
        }

        public function getBoundingBox(Request $request) {

            $planetId = $request->input('id');
            $planetUseCase = new GetPlanetUseCase($this->repository);
            $planet = $planetUseCase->__invoke($planetId);

            $boundingBox = $planetUseCase->getBoundingBox($planet->bounding_box());

            return $boundingBox;
        }
    }
