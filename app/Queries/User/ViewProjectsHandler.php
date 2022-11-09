<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ViewProjectsHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(ViewProjectsQuery $query): Collection
    {
        return $this->repository->getProjects($query);
    }
}
