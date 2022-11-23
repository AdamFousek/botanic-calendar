<?php

namespace App\Http\Livewire\Experiment\Forms;

use App\Command\Experiment\InsertExperimentCommand;
use App\Command\Experiment\InsertExperimentHandler;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateExperiment extends Component
{
    public int $projectId;

    public string $name = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'projectId' => 'required|integer',
    ];

    public function create(InsertExperimentHandler $insertExperimentHandler)
    {
        $validatedData = $this->validate();

        $userId = Auth::id();
        $experiment = $insertExperimentHandler->handle(new InsertExperimentCommand(
            $userId,
            $validatedData['name'],
            $validatedData['projectId'],
        ));

        return redirect()->route('experiments.show', [$experiment]);
    }
}
