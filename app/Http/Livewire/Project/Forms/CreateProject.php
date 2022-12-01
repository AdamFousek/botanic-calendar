<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Transformers\Models\UserTransformer;
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

    public array $members = [];

    public bool $allMembers = false;

    public string $username = '';

    public array $filteredUsers = [];

    protected $rules = [
        'project.name' => 'required|string|max:255',
        'project.description' => 'nullable|string',
        'project.is_public' => 'boolean',
        'allMembers' => 'boolean',
        'members' => 'nullable|array',
    ];

    public function mount()
    {
        $this->project = new Project();
        $this->user = Auth::user();

        if ($this->user === null) {
            return redirect()->route('welcome');
        }
    }

    public function render(UserTransformer $userTransformer)
    {
        $this->filteredUsers = [];
        if ($this->username !== '') {
            $users = $this->group?->members;
            /** @var User $user */
            foreach ($users as $user) {
                $upperSearch = strtoupper(trim($this->username));
                $firstNameUpper = strtoupper($user->first_name);
                $lastNameUpper = strtoupper($user->last_name);
                $usernameUpper = strtoupper($user->username);

                if (
                    str_contains($firstNameUpper, $upperSearch) ||
                    str_contains($lastNameUpper, $upperSearch) ||
                    str_contains($usernameUpper, $upperSearch)
                ) {
                    $this->filteredUsers[$user->id] = $userTransformer->transform($user);
                }
            }
        }

        return view('livewire.project.forms.create-project');
    }

    public function create(InsertProjectHandler $insertProjectHandler)
    {
        $this->authorize('create', [Project::class, $this->group]);

        $validatedData = $this->validate();

        $project = $insertProjectHandler->handle(new InsertProjectCommand(
            $this->project,
            $this->user,
            $validatedData['members'],
            $validatedData['allMembers'],
            $this->group,
        ));

        return redirect()->route('projects.show', [$project]);
    }
}
