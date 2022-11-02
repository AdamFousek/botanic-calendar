<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMemberMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private readonly Invitation $invitation,
    ) {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = route('groups.acceptInvitation', ['group' => $this->invitation->group, 'invitation' => $this->invitation->uuid]);

        return $this->view('emails.group.invitation-email', [
            'groupUuid' => $this->invitation->group->uuid,
            'hash' => $this->invitation->uuid,
            'link' => $link,
        ]);
    }
}
