<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Events\Group\InviteMemberEvent;
use App\Models\Group;
use App\Models\Invitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class InviteMemberHandler
{
    public function handle(InviteMemberCommand $command): void
    {
        $user = User::where(['email' => $command->email])->first();
        if ($user === null) {
            throw new RuntimeException(trans('User not found'));
        }
        $group = $command->group;
        if ($group->members->contains($user->id)) {
            throw new RuntimeException(trans('User is already in this group'));
        }

        if ($this->invitationExists($user, $group)) {
            throw new RuntimeException(trans('Invitation already exists'));
        }

        $this->expireInvitation($user, $group);

        $invitation = $this->createNewInvitation($user, $group);

        InviteMemberEvent::dispatch($invitation);
    }

    private function invitationExists(User $user, Group $group): bool
    {
        $pastInterval = (new Carbon())->days(-Invitation::INVITATION_EXPIRATION_IN_DAYS);

        return DB::table('invitations')
            ->where([
                'user_id' => $user->id,
                'group_id' => $group->id,
                'used' => false,
            ])
            ->whereDate('created_at', '>', $pastInterval)
            ->exists();
    }

    /**
     * Make invitation expire.
     * @param User $user
     * @param Group $group
     * @return void
     */
    private function expireInvitation(User $user, Group $group): void
    {
        $unusedInvitation = DB::table('invitations')
            ->where([
                'user_id' => $user->id,
                'group_id' => $group->id,
                'used' => false,
            ]);

        if ($unusedInvitation !== null) {
            $unusedInvitation->delete();
        }
    }

    private function createNewInvitation(User $user, Group $group): Invitation
    {
        $invitation = new Invitation();
        $invitation->hash = Str::uuid();
        $invitation->group_id = $group->id;
        $invitation->user_id = $user->id;
        $invitation->used = false;
        $invitation->save();

        return $invitation;
    }
}
