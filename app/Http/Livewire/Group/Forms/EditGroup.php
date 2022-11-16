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

    public string $name = '';

    public bool $isPublic = false;

    public string $description = '';

    public Group $group;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'description' => 'nullable|string',
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
        $this->authorize('edit', $this->group);

        $validatedData = $this->validate();

        $group = $updateGroupHandler->handle(new UpdateGroupCommand(
            $this->group->id,
            $validatedData['name'],
            $validatedData['description'],
            $validatedData['isPublic'],
        ));

        return redirect()
            ->route('groups.show', [$group])
            ->with('success', trans('Group was edited successfully!'));
    }
}
