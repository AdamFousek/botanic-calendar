<?php

namespace App\Http\Livewire\Experiment\Pages;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public function mount(Experiment $experiment)
    {
        $this->authorize('update', $experiment);

        $this->experiment = $experiment;
    }

    public function render()
    {
        return view('livewire.experiment.pages.edit');
    }
}
