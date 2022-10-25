<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\DeleteProjectCommand;
use App\Command\Project\DeleteProjectHandler;
use App\Models\Project;
use App\Queries\Project\ViewProjectByUuidHandler;
use App\Queries\Project\ViewProjectByUuidQuery;
use Livewire\Component;

class DeleteProject extends Component
{
    public string $uuid;

    public Project $project;

    public function mount(ViewProjectByUuidHandler $viewProjectHandler): void
    {
        $project = $viewProjectHandler->handle(new ViewProjectByUuidQuery($this->uuid));

        if ($project === null) {
            redirect()->back();
        }
    }

    public function delete(DeleteProjectHandler $deleteProjectHandler)
    {
        $this->authorize('delete', $this->project);

        $deleteProjectHandler->handle(new DeleteProjectCommand(
            $this->uuid,
        ));

        return redirect()->route('projects.index');
    }
}
