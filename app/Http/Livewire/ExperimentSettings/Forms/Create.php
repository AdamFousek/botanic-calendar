<?php

namespace App\Http\Livewire\ExperimentSettings\Forms;

use App\Models\ExperimentSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public const ALLOWED_INPUT_TYPES = [
        'text',
        'datetime',
        'number',
    ];

    public ?ExperimentSettings $experimentSettings;

    public array $actions = [];

    public array $fields = [];

    protected array $rules = [
        'actions' => 'required|array|min:1',
        'actions.*.name' => 'sometimes|required|string|max:255',
        'fields' => 'sometimes|array',
        'fields.*.name' => 'sometimes|required|string|max:255',
        'fields.*.type' => 'sometimes|required|in:text,datetime,number',
    ];

    public function mount()
    {
        if ($this->experimentSettings === null) {
            $this->experimentSettings = new ExperimentSettings();
        }

        $settings = json_decode($this->experimentSettings->setting ?? '{}', true, 512, JSON_THROW_ON_ERROR);

        $this->actions = $settings['actions'] ?? [];
        $this->fields = $settings['fields'] ?? [];
    }

    public function render()
    {
        return view('livewire.experiment-settings.forms.create');
    }

    public function addAction(): void
    {
        $data = [
            'name' => '',
        ];

        $this->actions[] = $data;
    }

    public function removeAction(int $index): void
    {
        unset($this->actions[$index]);
    }

    public function addField(): void
    {
        $data = [
            'name' => '',
            'type' => '',
        ];

        $this->fields[] = $data;
    }

    public function removeField(int $index): void
    {
        unset($this->fields[$index]);
    }
}
