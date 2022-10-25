<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;

class UpdateProjectHandler
{
    public function __construct(
        private readonly ProjectRepositoryInterface $repository,
    ) {
    }

    public function handle(UpdateProjectCommand $command): Project
    {
        return $this->repository->update($command);
    }
}
