<?php

namespace App\Http\Livewire\Experiment\Pages;

use App\Models\Experiment;
use App\Models\ExperimentSettings;
use App\Transformers\Models\ExperimentSettingsTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public ?ExperimentSettings $experimentSettings;

    public function mount(Experiment $experiment)
    {
        $this->authorize('update', $experiment);

        $this->experiment = $experiment;
        $this->experimentSettings = $experiment->settings;
    }

    public function render(ExperimentSettingsTransformer $experimentSettingsTransformer)
    {
        $data = [
            'settings' => $experimentSettingsTransformer->transform($this->experimentSettings),
        ];

        return view('livewire.experiment.pages.edit', $data);
    }
}
