<?php

declare(strict_types=1);

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\InviteMemberCommand;
use App\Command\Group\InviteMemberHandler;
use App\Models\Group;
use App\Queries\Group\ViewGroupByUuidHandler;
use App\Queries\Group\ViewGroupByUuidQuery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class InviteMember extends Component
{
    use AuthorizesRequests;

    public string $uuid;

    public string $email = '';

    public Group $group;

    protected array $rules = [
        'email' => 'required|email',
    ];

    public function mount(ViewGroupByUuidHandler $viewGroupByUuidHandler): void
    {
        $group = $viewGroupByUuidHandler->handle(new ViewGroupByUuidQuery($this->uuid));

        if ($group === null) {
            redirect()->route('groups.index');
        }

        $this->group = $group;
    }

    public function invite(InviteMemberHandler $inviteMemberHandler)
    {
        $this->authorize('inviteMember', $this->group);

        $validatedData = $this->validate(
            ['email' => 'required|email|exists:users,email'],
            [
                'email.exists' => trans('User with this email does not exists!'),
            ],
            ['email' => 'Email Address']
        );

        try {
            $inviteMemberHandler->handle(new InviteMemberCommand(
                $this->group,
                $validatedData['email'],
            ));

            redirect()->route('groups.show', $this->group)->with('success', trans('Invitation send!'));
        } catch (\Exception $exception) {
            redirect()->route('groups.show', $this->group)->with('error', $exception->getMessage());
        }
    }
}
