<?php

declare(strict_types=1);

namespace App\Command\Group;

class InviteMember
{
    public function __construct(
        private readonly int $groupId,
        private readonly string $email,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }
}
