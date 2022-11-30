<?php

namespace App\Http\Livewire\Group\Forms;

use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditGroup extends Component
{
    use AuthorizesRequests;

    public Group $group;

    protected array $rules = [
        'group.name' => 'required|string|max:255',
        'group.is_public' => 'nullable',
        'group.description' => 'nullable|string',
    ];

    public function update()
    {
        $this->authorize('update', $this->group);

        $this->validate();

        $this->group->save();

        return redirect()
            ->route('groups.show', [$this->group])
            ->with('success', trans('Group was edited successfully!'));
    }
}
