<?php

namespace App\Http\Livewire\Group\Forms;

use App\Models\Group;
use Livewire\Component;

class InviteMember extends Component
{
    public Group $group;

    public function render()
    {
        return view('livewire.group.forms.invite-member');
    }
}
