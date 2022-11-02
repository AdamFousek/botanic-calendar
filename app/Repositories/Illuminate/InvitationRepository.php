<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Command\Invitation\AcceptInvitationCommand;
use App\Models\Group;
use App\Models\Invitation;
use App\Models\User;
use App\Repositories\InvitationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function invitationExists(User $user, Group $group): bool
    {
        $pastSevenDays = (new Carbon())->days(-Invitation::INVITATION_EXPIRATION_IN_DAYS);

        return DB::table('invitations')
            ->where([
                'user_id' => $user->id,
                'group_id' => $group->id,
                'used' => false,
                'created_at' => $pastSevenDays,
            ])->exists();
    }

    public function expireInvitation(User $user, Group $group): bool
    {
        $unusedInvitation = DB::table('invitations')
            ->where([
                'user_id' => $user->id,
                'group_id' => $group->id,
                'used' => false,
            ]);

        if ($unusedInvitation !== null) {
            $unusedInvitation->delete();

            return true;
        }

        return false;
    }

    public function create(User $user, Group $group): Invitation
    {
        $invitation = new Invitation();
        $invitation->uuid = Str::uuid();
        $invitation->group_id = $group->id;
        $invitation->user_id = $user->id;
        $invitation->used = false;
        $invitation->save();

        return $invitation;
    }

    public function accept(AcceptInvitationCommand $command): bool
    {
        $invitation = $command->getInvitation();
        $group = $command->getGroup();
        $user = $command->getUser();

        $group->members()->attach($user->id, ['is_admin' => 0]);
        $invitation->used = true;
        $invitation->save();

        return true;
    }
}
