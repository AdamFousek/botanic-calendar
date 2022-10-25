<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Repositories\ProjectRepositoryInterface;

class DeleteProjectHandler
{
    public function __construct(
        private readonly ProjectRepositoryInterface $repository,
    ) {
    }

    public function handle(DeleteProjectCommand $command)
    {
        $this->repository->delete($command->getUuid());
    }
}
