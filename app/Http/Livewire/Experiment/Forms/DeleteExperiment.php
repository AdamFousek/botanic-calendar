<?php

namespace App\Http\Livewire\Experiment\Forms;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteExperiment extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public function delete()
    {
        $this->authorize('delete', $this->experiment);

        $project = $this->experiment->project;

        $this->experiment->delete();

        redirect()->route('projects.show', $project)
            ->with('success', trans('Experiment was deleted'));
    }
}
