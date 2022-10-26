<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Models\Group;
use App\Models\User;
use App\Repositories\InvitationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvitationRepository implements InvitationRepositoryInterface
{
    private const INVITATION_EXPIRATION_IN_DAYS = 7;

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
}
