<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\UpdateProjectCommand;
use App\Command\Project\UpdateProjectHandler;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditProject extends Component
{
    use AuthorizesRequests;
    use MembersTrait;

    public Project $project;

    public ?int $groupId;

    public array $members = [];

    public bool $allMembers = false;

    public string $username = '';

    public array $filteredUsers = [];

    protected array $rules = [
        'project.name' => 'required|string|max:255',
        'project.is_public' => 'boolean',
        'project.description' => 'nullable|string',
        'members' => 'nullable|array',
        'allMembers' => 'boolean',
    ];

    public function mount(Project $project): void
    {
        $this->project = $project;
        $this->members = $this->project->members->toArray();
    }

    public function update(UpdateProjectHandler $updateProjectHandler)
    {
        $this->authorize('update', $this->project);

        $validatedData = $this->validate();

        $project = $updateProjectHandler->handle(new UpdateProjectCommand(
            $this->project,
            $validatedData['members'],
            $validatedData['allMembers'],
        ));

        return redirect()
            ->route('projects.show', [$project])
            ->with('success', trans('Project was edited successfully!'));
    }
}
