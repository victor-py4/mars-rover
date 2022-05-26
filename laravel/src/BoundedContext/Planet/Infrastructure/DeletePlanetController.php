<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Planet\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Planet\Application\DeletePlanetUseCase;
    use Src\BoundedContext\Planet\Infrastructure\Repositories\EloquentPlanetRepository;
    

    final class DeletePlanetController
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
            $deleteplanetUseCase = new DeletePlanetUseCase($this->repository);

            $deleteplanetUseCase->__invoke($planetId);
        }
    }