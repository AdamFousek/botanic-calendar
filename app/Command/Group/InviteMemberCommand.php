<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;

class InviteMemberCommand
{
    public function __construct(
        public readonly Group $group,
        public readonly string $email,
    ) {
    }
}
