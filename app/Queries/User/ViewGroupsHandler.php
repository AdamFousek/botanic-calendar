<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ViewGroupsHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(ViewGroupsQuery $query): Collection
    {
        return $this->repository->getGroups($query);
    }
}
