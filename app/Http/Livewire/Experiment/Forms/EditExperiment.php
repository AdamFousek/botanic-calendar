<?php

namespace App\Http\Livewire\Experiment\Forms;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditExperiment extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    protected array $rules = [
        'experiment.name' => 'required|string|max:255',
    ];

    public function update()
    {
        $this->authorize('update', $this->experiment);

        $this->validate();

        $this->experiment->save();

        redirect()
            ->route('experiment.edit', [$this->experiment->project, $this->experiment])
            ->with('success', trans('Experiment was edited successfully!'));
    }
}
