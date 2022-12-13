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
        'experiment.color' => [
            'required',
            'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i',
        ],
    ];

    public function update()
    {
        $this->authorize('update', $this->experiment);

        $this->validate();

        $this->experiment->name = trim($this->experiment->name);

        $this->experiment->save();

        return redirect()
            ->route('experiment.edit', [$this->experiment->project, $this->experiment])
            ->with('success', trans('Experiment was edited successfully!'));
    }
}
