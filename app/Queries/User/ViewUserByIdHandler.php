<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class ViewUserByIdHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(ViewUserByIdQuery $query): ?User
    {
        return $this->repository->getById($query);
    }
}
