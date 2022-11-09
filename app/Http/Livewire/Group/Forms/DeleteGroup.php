<?php

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\DeleteGroupCommand;
use App\Command\Group\DeleteGroupHandler;
use App\Models\Group;
use App\Queries\Group\ViewGroupByUuidHandler;
use App\Queries\Group\ViewGroupByUuidQuery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class DeleteGroup extends Component
{
    use AuthorizesRequests;

    public string $uuid;

    public Group $group;

    public function mount(ViewGroupByUuidHandler $viewGroupByUuidHandler): void
    {
        $group = $viewGroupByUuidHandler->handle(new ViewGroupByUuidQuery($this->uuid));

        if ($group === null) {
            redirect()->back();
        }

        $this->group = $group;
    }

    public function delete(DeleteGroupHandler $deleteGroupHandler): RedirectResponse
    {
        $this->authorize('delete', $this->group);

        $deleteGroupHandler->handle(new DeleteGroupCommand(
            $this->uuid,
        ));

        return redirect()->route('projects.index');
    }
}
