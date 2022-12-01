<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\DeleteProjectCommand;
use App\Command\Project\DeleteProjectHandler;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteProject extends Component
{
    use AuthorizesRequests;

    public Project $project;

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function delete(DeleteProjectHandler $deleteProjectHandler): void
    {
        $this->authorize('delete', $this->project);

        $deleteProjectHandler->handle(new DeleteProjectCommand(
            $this->project,
        ));

        redirect()->route('projects.index');
    }
}
