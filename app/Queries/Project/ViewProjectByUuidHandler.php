<?php

declare(strict_types=1);

namespace App\Queries\Project;

use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;

class ViewProjectByUuidHandler
{
    public function __construct(
        private readonly ProjectRepositoryInterface $repository,
    ) {
    }

    public function handle(ViewProjectByUUidQuery $query): ?Project
    {
        return $this->repository->getByUuid($query->getUuid());
    }
}
