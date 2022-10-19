<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;

class InviteMember
{
    public function __construct(
        private readonly Group $group,
        private readonly string $email,
    ) {
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
