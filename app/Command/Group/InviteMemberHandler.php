<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Repositories\GroupRepositoryInterface;

class InviteMemberHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $repository,
    ) {
    }

    public function handle(InviteMember $command): void
    {
        $this->repository->inviteMember($command->getGroupId(), $command->getEmail());
    }
}
