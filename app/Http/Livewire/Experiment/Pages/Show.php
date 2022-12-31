<?php

namespace App\Http\Livewire\Experiment\Pages;

use App\Models\Experiment;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public Project $project;

    public Experiment $experiment;

    public function mount(Project $project, Experiment $experiment)
    {
        $this->authorize('view', $this->experiment);

        $this->project = $project;
        $this->experiment = $experiment;
    }

    public function render()
    {
        $this->authorize('view', $this->experiment);

        return view('livewire.experiment.pages.show');
    }
}
