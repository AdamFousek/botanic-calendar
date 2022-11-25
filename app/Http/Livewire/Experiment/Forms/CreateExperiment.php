<?php

namespace App\Http\Livewire\Experiment\Forms;

use App\Command\Experiment\InsertExperimentCommand;
use App\Command\Experiment\InsertExperimentHandler;
use App\Models\Experiment;
use App\Models\Project;
use App\Models\User;
use App\Queries\Project\ViewProjectByUuidHandler;
use App\Queries\Project\ViewProjectByUuidQuery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateExperiment extends Component
{
    use AuthorizesRequests;

    public string $projectUuid;

    public Project $project;

    public string $experimentName = '';

    protected array $rules = [
        'experimentName' => 'required|string|max:255',
    ];

    public function mount(ViewProjectByUuidHandler $viewProjectByUuidHandler): void
    {
        $this->project = $viewProjectByUuidHandler->handle(new ViewProjectByUuidQuery(
            $this->projectUuid,
        ));
    }

    public function create(InsertExperimentHandler $insertExperimentHandler)
    {
        $this->authorize('create', [Experiment::class, $this->project]);

        $validatedData = $this->validate();

        $user = Auth::user();
        if (! $user instanceof User) {
            return redirect()->route('welcome');
        }

        $experiment = $insertExperimentHandler->handle(new InsertExperimentCommand(
            $user->id,
            $validatedData['experimentName'],
            $this->project->id,
        ));

        return redirect()->route('experiments.show', [$experiment]);
    }
}
