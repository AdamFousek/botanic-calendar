<?php

namespace App\Http\Livewire\Group\Actions;

use App\Command\Invitation\AcceptInvitationCommand;
use App\Command\Invitation\AcceptInvitationHandler;
use App\Http\Exceptions\Invitation\ForbiddenInvitationException;
use App\Http\Exceptions\Invitation\InvalidInvitationException;
use App\Models\Group;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AcceptInvitation extends Component
{
    public Group $group;

    public Invitation $invitation;

    public function mount(Group $group, Invitation $invitation)
    {
        $this->group = $group;
        $this->invitation = $invitation;
    }

    public function render(AcceptInvitationHandler $acceptInvitationHandler)
    {
        $user = Auth::user();
        try {
            $acceptInvitationHandler->handle(new AcceptInvitationCommand(
                $user,
                $this->group,
                $this->invitation,
            ));
        } catch (InvalidInvitationException) {
            session()->flash('error', trans('Invitation expired. Please ask for new one.'));
            $this->redirect(route('groups.index'));

            return view('livewire.group.actions.accept-invitation');
        } catch (ForbiddenInvitationException) {
            abort(404);
        }

        $this->redirect(route('groups.show', $this->group));

        return view('livewire.group.actions.accept-invitation');
    }
}
