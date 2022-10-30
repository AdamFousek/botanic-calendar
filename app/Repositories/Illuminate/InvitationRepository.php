<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Models\Group;
use App\Models\Invitation;
use App\Models\User;
use App\Repositories\InvitationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationRepository implements InvitationRepositoryInterface
{
    private const INVITATION_EXPIRATION_IN_DAYS = 1;

    public function invitationExists(User $user, Group $group): bool
    {
        $pastSevenDays = (new Carbon())->days(-self::INVITATION_EXPIRATION_IN_DAYS);

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
}
