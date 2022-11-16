<?php

namespace App\Listeners\Group;

use App\Events\Group\InviteMemberEvent;
use App\Mail\InviteMemberMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendInvitationListener implements ShouldQueue
{
    public string $queue = 'mail';

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
     * @param  \App\Events\Group\InviteMemberEvent  $event
     * @return void
     */
    public function handle(InviteMemberEvent $event)
    {
        $invitation = $event->getInvitation();

        Mail::to($invitation->user)
            ->send(new InviteMemberMail($invitation));
    }
}
