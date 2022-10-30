<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Events\Group\InviteMemberEvent;
use App\Repositories\GroupRepositoryInterface;
use App\Repositories\InvitationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class InviteMemberHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $repository,
        private readonly InvitationRepositoryInterface $invitationRepository,
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function handle(InviteMember $command): void
    {
        $user = $this->userRepository->getByEmail($command->getEmail());
        $group = $this->repository->viewByUuid($command->getGroupUuid());

        if ($user === null || $group === null) {
            throw new \RuntimeException('User or group not found');
        }

        if ($this->invitationRepository->invitationExists($user, $group)) {
            return;
        }

        $this->invitationRepository->expireInvitation($user, $group);

        $invitation = $this->invitationRepository->create($user, $group);

        InviteMemberEvent::dispatch($invitation);
    }
}
