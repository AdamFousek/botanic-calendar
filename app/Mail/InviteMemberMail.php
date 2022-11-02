<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
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

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('botcal@adamfousek.cz'),
            subject: trans('Botanic - Invitation to a Group'),
        );
    }

    public function content(): Content
    {
        $link = route('groups.acceptInvitation', ['group' => $this->invitation->group, 'invitation' => $this->invitation->uuid]);

        return new Content(
            view: 'emails.group.invitation-email',
            with: [
                'groupUuid' => $this->invitation->group->uuid,
                'hash' => $this->invitation->uuid,
                'link' => $link,
            ],
        );
    }
}
