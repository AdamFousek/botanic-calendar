<?php

namespace App\Events\Group;

use App\Models\Invitation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InviteMemberEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        private readonly Invitation $invitation,
    ) {
    }

    public function getInvitation(): Invitation
    {
        return $this->invitation;
    }
}
