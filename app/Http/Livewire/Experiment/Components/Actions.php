<?php

namespace App\Http\Livewire\Experiment\Components;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Actions extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public function mount()
    {
        $this->authorize('update', $this->experiment);
    }

    public function render()
    {
        return view('livewire.experiment.components.actions');
    }
}
