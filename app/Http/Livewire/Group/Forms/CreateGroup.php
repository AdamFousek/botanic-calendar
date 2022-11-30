<?php

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\InsertGroupCommand;
use App\Command\Group\InsertGroupHandler;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateGroup extends Component
{
    public Group $group;

    protected $rules = [
        'group.name' => 'required|string|max:255',
        'group.is_public' => 'nullable',
        'group.description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->group = new Group();
    }

    public function create(InsertGroupHandler $insertGroupHandler)
    {
        $this->validate();

        $user = Auth::user();
        if (! $user instanceof User) {
            return redirect()->route('welcome');
        }

        $group = $insertGroupHandler->handle(new InsertGroupCommand(
            $user,
            $this->group,
        ));

        return redirect()->route('groups.show', [$group]);
    }
}
