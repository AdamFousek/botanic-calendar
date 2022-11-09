<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UpdateUserHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(UpdateUserCommand $command): User
    {
        return $this->repository->update($command);
    }
}
