<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class ViewUserByEmailHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(ViewUserByEmailQuery $command): ?User
    {
        return $this->repository->getByEmail($command->getEmail());
    }
}
