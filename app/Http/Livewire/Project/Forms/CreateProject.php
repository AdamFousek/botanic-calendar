<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateProject extends Component
{
    use AuthorizesRequests;
    use MembersTrait;

    public Project $project;

    public ?Group $group = null;

    public ?User $user;

    public bool $allMembers = false;

    protected $rules = [
        'project.name' => 'required|string|max:255',
        'project.description' => 'nullable|string',
        'project.is_public' => 'boolean',
        'allMembers' => 'boolean',
    ];

    public function mount()
    {
        $this->project = new Project();
        $this->project->is_public = false;
        $this->user = Auth::user();
        $this->members = new Collection();

        if ($this->user === null) {
            return redirect()->route('welcome');
        }
    }

    public function render()
    {
        $this->searchUser();

        return view('livewire.project.forms.create-project');
    }

    public function create(InsertProjectHandler $insertProjectHandler)
    {
        $this->authorize('create', [Project::class, $this->group]);

        $validatedData = $this->validate();

        $project = $insertProjectHandler->handle(new InsertProjectCommand(
            $this->project,
            $this->user,
            $this->members,
            $validatedData['allMembers'],
            $this->group,
        ));

        return redirect()->route('projects.show', [$project]);
    }
}
