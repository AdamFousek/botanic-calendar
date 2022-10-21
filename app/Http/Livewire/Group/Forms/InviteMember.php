<?php

declare(strict_types=1);

namespace App\Http\Livewire\Group\Forms;

use Livewire\Component;

class InviteMember extends Component
{
    public string $groupUUID;

    public function render()
    {
        return view('livewire.group.forms.invite-member');
    }
}
