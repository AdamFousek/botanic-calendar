<?php

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\UpdateGroupCommand;
use App\Command\Group\UpdateGroupHandler;
use App\Models\Group;
use App\Queries\Group\ViewGroupByUuidHandler;
use App\Queries\Group\ViewGroupByUuidQuery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditGroup extends Component
{
    use AuthorizesRequests;

    public string $uuid;

    public string $groupName = '';

    public bool $isPublic = false;

    public string $groupDescription = '';

    public Group $group;

    protected array $rules = [
        'groupName' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'groupDescription' => 'nullable|string',
    ];

    public function mount(ViewGroupByUuidHandler $viewGroupByUuidHandler): void
    {
        $group = $viewGroupByUuidHandler->handle(new ViewGroupByUuidQuery($this->uuid));

        if ($group === null) {
            redirect()->route('projects.index');
        }

        $this->group = $group;
        $this->name = $group->name;
        $this->isPublic = $group->is_public;
        $this->description = $group->description;
    }

    public function update(
        UpdateGroupHandler $updateGroupHandler,
    ) {
        $this->authorize('update', $this->group);

        $validatedData = $this->validate();

        $group = $updateGroupHandler->handle(new UpdateGroupCommand(
            $this->group->id,
            $validatedData['groupName'],
            $validatedData['groupDescription'],
            $validatedData['isPublic'],
        ));

        return redirect()
            ->route('groups.show', [$group])
            ->with('success', trans('Group was edited successfully!'));
    }
}
