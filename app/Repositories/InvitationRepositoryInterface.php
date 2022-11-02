<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Command\Invitation\AcceptInvitationCommand;
use App\Models\Group;
use App\Models\Invitation;
use App\Models\User;

interface InvitationRepositoryInterface
{
    public function invitationExists(User $user, Group $group): bool;

    public function expireInvitation(User $user, Group $group): bool;

    public function create(User $user, Group $group): Invitation;

    public function accept(AcceptInvitationCommand $command);
}
