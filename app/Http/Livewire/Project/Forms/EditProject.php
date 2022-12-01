<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\UpdateProjectCommand;
use App\Command\Project\UpdateProjectHandler;
use App\Models\Group;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditProject extends Component
{
    use AuthorizesRequests;
    use MembersTrait;

    public Project $project;

    public ?Group $group;

    public bool $allMembers = false;

    protected array $rules = [
        'project.name' => 'required|string|max:255',
        'project.is_public' => 'boolean',
        'project.description' => 'nullable|string',
        'allMembers' => 'boolean',
    ];

    public function mount(Project $project): void
    {
        $this->project = $project;
        $this->members = $this->project->members->keyBy('id');
    }

    public function render()
    {
        $this->searchUser();

        return view('livewire.project.forms.edit-project');
    }

    public function update(UpdateProjectHandler $updateProjectHandler)
    {
        $this->authorize('update', $this->project);

        $validatedData = $this->validate();

        $project = $updateProjectHandler->handle(new UpdateProjectCommand(
            $this->project,
            $this->members,
            $validatedData['allMembers'],
        ));

        return redirect()
            ->route('projects.show', [$project])
            ->with('success', trans('Project was edited successfully!'));
    }
}
