<?php

namespace App\Http\Livewire\Group\Pages;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public ?Group $group = null;

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function render()
    {
        $this->authorize('view', $this->group);

        $user = Auth::user();

        $members = $this->group->members()->orderByPivot('is_admin', 'desc')->orderBy('last_name')->get();
        $projects = $this->group->projects()->with(['group', 'user'])->get();

        $data = [
            'group' => $this->group,
            'members' => $members,
            'projects' => $projects,
            'canCreateProject' => $user?->can('create', [Project::class, $this->group]) ?? false,
        ];

        return view('livewire.group.pages.show', $data);
    }
}
