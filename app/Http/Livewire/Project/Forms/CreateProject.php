<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Queries\Group\ViewGroupByUuidHandler;
use App\Queries\Group\ViewGroupByUuidQuery;
use App\Transformers\Models\UserTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Str;

class CreateProject extends Component
{
    use AuthorizesRequests;

    public string $projectName = '';

    public bool $isPublic = false;

    public string $projectDescription = '';

    public ?string $groupUuid = null;

    public ?Group $group = null;

    /** @var User[] */
    public array $members = [];

    public bool $allMembers = false;

    public string $username = '';

    public array $filteredUsers = [];

    protected $rules = [
        'projectName' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'projectDescription' => 'nullable|string',
        'allMembers' => 'nullable',
        'members' => 'nullable|array',
    ];

    public function mount(ViewGroupByUuidHandler $viewGroupByUuidHandler): void
    {
        if ($this->groupUuid) {
            $this->group = $viewGroupByUuidHandler->handle(new ViewGroupByUuidQuery($this->groupUuid));
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

    public function toggleMembers($userId): void
    {
        if (isset($this->members[$userId])) {
            unset($this->members[$userId]);
        } else {
            $this->members[$userId] = $this->filteredUsers[$userId];
        }

        $this->username = '';
        $this->filteredUsers = [];
    }

    public function create(InsertProjectHandler $insertProjectHandler)
    {
        $this->authorize('create', [Project::class, $this->group]);

        $validatedData = $this->validate();

        $user = Auth::user();
        if (! $user instanceof User) {
            return redirect()->route('welcome');
        }

        $project = $insertProjectHandler->handle(new InsertProjectCommand(
            $user->id,
            Str::uuid(),
            $validatedData['projectName'],
            $validatedData['isPublic'] ?? false,
            $validatedData['projectDescription'] ?? '',
            $validatedData['members'],
            $validatedData['allMembers'],
            $this->group?->id,
        ));

        return redirect()->route('projects.show', [$project]);
    }
}
