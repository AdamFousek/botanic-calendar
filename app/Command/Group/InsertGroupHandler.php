<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;
use App\Repositories\GroupRepositoryInterface;

class InsertGroupHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $repository,
    ) {
    }

    public function handle(InsertGroupCommand $command): Group
    {
        return $this->repository->insert($command);
    }
}
