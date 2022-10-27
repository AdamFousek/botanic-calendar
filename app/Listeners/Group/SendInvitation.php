<?php

namespace App\Listeners\Group;

use App\Events\Group\InviteMember;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvitation implements ShouldQueue
{
    public string $queue = 'invitation';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Group\InviteMember  $event
     * @return void
     */
    public function handle(InviteMember $event)
    {
        $invitation = $event->getInvitation();

        send_email();
    }
}
