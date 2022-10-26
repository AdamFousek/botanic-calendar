<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;
use App\Models\User;

class InviteMemberCommand
{
    public function __construct(
        private readonly Group $group,
        private readonly User $user,
    ) {
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
