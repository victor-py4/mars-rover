<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Planet\Application\CreatePlanetUseCase;
    use Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;
    

    final class CreatePlanetController
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
            $planetBoundingBox = $request->input( 'bounding_box')?: null;            $planetCreatedAt = $request->input( 'created_at')?: null;            $planetObstacles = $request->input( 'obstacles')?: null;            $planetUpdatedAt = $request->input( 'updated_at')?: null;    

            $createPlanetUseCase = new CreatePlanetUseCase($this->repository);

            $createPlanetUseCase->__invoke(              $planetBoundingBox,              $planetCreatedAt,              $planetObstacles,              $planetUpdatedAt,    

            );

            return $createPlanetUseCase;
        }
    }