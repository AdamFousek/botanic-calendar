<?php

declare(strict_types=1);

namespace App\Command\Invitation;

use App\Http\Exceptions\Invitation\ForbiddenInvitationException;
use App\Http\Exceptions\Invitation\InvalidInvitationException;

class AcceptInvitationHandler
{
    public function handle(AcceptInvitationCommand $command): bool
    {
        if (! $command->getInvitation()->isValid()) {
            throw new InvalidInvitationException('Invitation is not valid. Please ask for new invitation');
        }

        if ($command->getInvitation()->user_id !== $command->getUser()->id) {
            throw new ForbiddenInvitationException('You have no rights for this invitation');
        }

        $invitation = $command->getInvitation();
        $group = $command->getGroup();
        $user = $command->getUser();

        $group->members()->attach($user->id, ['is_admin' => 0]);
        $invitation->used = true;
        $invitation->save();

        return true;
    }
}
