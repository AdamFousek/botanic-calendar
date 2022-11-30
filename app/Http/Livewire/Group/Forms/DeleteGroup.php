<?php

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\DeleteGroupCommand;
use App\Command\Group\DeleteGroupHandler;
use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteGroup extends Component
{
    use AuthorizesRequests;

    public Group $group;

    public function delete(DeleteGroupHandler $deleteGroupHandler)
    {
        $this->authorize('delete', $this->group);

        $deleteGroupHandler->handle(new DeleteGroupCommand(
            $this->group->uuid,
        ));

        return redirect()->route('groups.index');
    }
}
