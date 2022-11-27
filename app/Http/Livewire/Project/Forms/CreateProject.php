<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Queries\Group\ViewGroupByUuidHandler;
use App\Queries\Group\ViewGroupByUuidQuery;
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

    protected $rules = [
        'projectName' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'projectDescription' => 'nullable|string',
    ];

    public function mount(ViewGroupByUuidHandler $viewGroupByUuidHandler): void
    {
        if ($this->groupUuid) {
            $this->group = $viewGroupByUuidHandler->handle(new ViewGroupByUuidQuery($this->groupUuid));
        }
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
            $this->group?->id,
        ));

        return redirect()->route('projects.show', [$project]);
    }
}
