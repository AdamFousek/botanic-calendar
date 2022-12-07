<?php

namespace App\Http\Livewire\ExperimentSettings\Pages;

use App\Models\Experiment;
use App\Models\ExperimentSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public ?ExperimentSettings $experimentSettings;

    public function mount(Experiment $experiment)
    {
        $this->experiment = $experiment;
        $this->experimentSettings = new ExperimentSettings();
    }

    public function render()
    {
        return view('livewire.experiment-settings.pages.create');
    }
}
