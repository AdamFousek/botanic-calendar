<?php

namespace App\Http\Livewire\Experiment\Forms;

use App\Command\Experiment\InsertExperimentCommand;
use App\Command\Experiment\InsertExperimentHandler;
use App\Models\Experiment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateExperiment extends Component
{
    use AuthorizesRequests;

    public Project $project;

    public ?User $user;

    public Experiment $experiment;

    protected array $rules = [
        'experiment.name' => 'required|string|max:255',
        'experiment.color' => [
            'required',
            'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i',
        ],
    ];

    public function mount()
    {
        $this->authorize('create', [Experiment::class, $this->project]);

        $this->user = Auth::user();
        if (! $this->user instanceof User) {
            redirect()->route('welcome');
        }

        $this->experiment = new Experiment();
        $this->experiment->color = '#000';
    }

    public function create(InsertExperimentHandler $insertExperimentHandler)
    {
        $this->authorize('create', [Experiment::class, $this->project]);

        $this->validate();

        $experiment = $insertExperimentHandler->handle(new InsertExperimentCommand(
            $this->user,
            $this->experiment,
            $this->project,
        ));

        return redirect()
            ->route('experiment.show', [$this->project, $experiment])
            ->with('success', trans('Experiment was created successfully'));
    }
}
