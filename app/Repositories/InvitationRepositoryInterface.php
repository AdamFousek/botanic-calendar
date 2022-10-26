<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;
use App\Models\User;

interface InvitationRepositoryInterface
{
    public function invitationExists(User $user, Group $group): bool;
}
