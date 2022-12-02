<?php

namespace App\Http\Livewire\ExperimentSettings\Forms;

use App\Models\ExperimentSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public ?ExperimentSettings $experimentSettings;

    public ?array $settings = [];

    public function mount()
    {
        if ($this->experimentSettings === null) {
            $this->experimentSettings = new ExperimentSettings();
        }
    }

    public function render()
    {
        $this->settings = json_decode($this->experimentSettings->setting ?? '{"test": 12}', true, 512, JSON_THROW_ON_ERROR);

        return view('livewire.experiment-settings.forms.create');
    }
}
