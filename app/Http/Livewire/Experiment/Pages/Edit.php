<?php

namespace App\Http\Livewire\Experiment\Pages;

use App\Models\Experiment;
use App\Models\ExperimentSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public ?ExperimentSettings $experimentSettings;

    public function mount(Experiment $experiment)
    {
        $this->experiment = $experiment;
        $this->experimentSettings = $experiment->settings;
    }

    public function render()
    {
        return view('livewire.experiment.pages.edit');
    }
}
