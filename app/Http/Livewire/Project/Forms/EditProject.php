<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\UpdateProjectCommand;
use App\Command\Project\UpdateProjectHandler;
use App\Models\Project;
use App\Queries\Project\ViewProjectByUuidHandler;
use App\Queries\Project\ViewProjectByUuidQuery;
use App\Transformers\Models\UserTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditProject extends Component
{
    use AuthorizesRequests;
    use MembersTrait;

    public string $uuid;

    public string $projectName;

    public bool $isPublic;

    public ?int $groupId;

    public string $projectDescription;

    public Project $project;

    public array $members = [];

    public bool $allMembers = false;

    public string $username = '';

    public array $filteredUsers = [];

    protected array $rules = [
        'projectName' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'projectDescription' => 'nullable|string',
        'members' => 'nullable|array',
        'allMembers' => 'nullable',
    ];

    public function mount(
        ViewProjectByUuidHandler $viewProjectHandler,
        UserTransformer $userTransformer,
    ): void {
        $project = $viewProjectHandler->handle(new ViewProjectByUuidQuery($this->uuid));

        if ($project === null) {
            redirect()->route('projects.index');
        }

        $this->project = $project;
        $this->projectName = $project->name;
        $this->uuid = $project->uuid;
        $this->isPublic = $project->is_public;
        $this->groupId = $project->group_id;
        $this->projectDescription = $project->description;
        $this->members = $userTransformer->transformMulti($project->members);
    }

    public function update(UpdateProjectHandler $updateProjectHandler)
    {
        $this->authorize('update', $this->project);

        $validatedData = $this->validate();

        $project = $updateProjectHandler->handle(new UpdateProjectCommand(
            $this->project->id,
            $validatedData['projectName'],
            $validatedData['projectDescription'],
            $validatedData['isPublic'],
            $validatedData['members'],
        ));

        return redirect()
            ->route('projects.show', [$project])
            ->with('success', trans('Project was edited successfully!'));
    }
}
