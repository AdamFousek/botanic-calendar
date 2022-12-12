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

        $this->experiment->save();
    }
}
