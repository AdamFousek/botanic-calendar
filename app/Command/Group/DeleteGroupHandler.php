<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Repositories\GroupRepositoryInterface;

class DeleteGroupHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $repository,
    ) {
    }

    public function handle(DeleteGroupCommand $command): void
    {
        $this->repository->delete($command);
    }
}
