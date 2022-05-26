<?php

    declare(strict_types=1);

    namespace Src\BoundedContext\Rover\Infrastructure;

    use Illuminate\Http\Request;
    use Src\BoundedContext\Rover\Application\DeleteRoverUseCase;
    use Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;
    

    final class DeleteRoverController
    {
        /**
         * @var \Src\BoundedContext\Rover\Infrastructure\Repositories\EloquentRoverRepository;
         */
        private $repository;

        public function __construct(EloquentRoverRepository $repository)
        {
            $this->repository = $repository;
        }

        public function __invoke(Request $request) {

            $roverId = $request->input('id');
            $deleteroverUseCase = new DeleteRoverUseCase($this->repository);

            $deleteroverUseCase->__invoke($roverId);
        }
    }