<?php

declare(strict_types=1);

namespace App\Queries\Group;

use App\Models\Group;
use App\Repositories\GroupRepositoryInterface;

class ViewGroupByUuidHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $repository,
    ) {
    }

    public function handle(ViewGroupByUuidQuery $query): ?Group
    {
        return $this->repository->viewByUuid($query->getUuid());
    }
}
