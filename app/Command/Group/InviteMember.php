<?php

declare(strict_types=1);

namespace App\Command\Group;

class InviteMember
{
    public function __construct(
        private readonly string $groupUuid,
        private readonly string $email,
    ) {
    }

    public function getGroupUuid(): string
    {
        return $this->groupUuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
