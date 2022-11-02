<?php

declare(strict_types=1);

namespace App\Command\Invitation;

use App\Models\Group;
use App\Models\Invitation;
use App\Models\User;

class AcceptInvitationCommand
{
    public function __construct(
        private readonly User $user,
        private readonly Group $group,
        private readonly Invitation $invitation,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function getInvitation(): Invitation
    {
        return $this->invitation;
    }
}
