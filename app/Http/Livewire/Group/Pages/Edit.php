<?php

namespace App\Http\Livewire\Group\Pages;

use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Group $group;

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function render()
    {
        $this->authorize('update', $this->group);

        return view('livewire.group.pages.edit');
    }
}
