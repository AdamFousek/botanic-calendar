<?php

namespace App\Http\Livewire\ExperimentSettings\Forms;

use App\Command\Experiment\InsertExperimentSettingsCommand;
use App\Command\Experiment\InsertExperimentSettingsHandler;
use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Experiment\Action $action;

    public array $fields = [];

    public array $notifications = [];

    public string $color = '';

    protected array $rules = [
        'action.name' => 'sometimes|required|string|max:255',
        'action.fields' => 'sometimes|array',
        'action.fields.*.name' => 'sometimes|required|string|max:255',
        'action.fields.*.type' => 'sometimes|required|in:text,datetime,number,select',
        'action.fields.*.options' => 'sometimes|array',
        'action.fields.*.options.*.name' => 'sometimes|required|string|max:255',
        'action.notifications' => 'sometimes|array',
        'action.notifications.*.days' => 'sometimes|required|int|min:1',
        'action.operations' => 'sometimes|array',
        'action.operations',
    ];

    public function mount()
    {
        $this->experimentSettings = $this->experiment->settings ?? new ExperimentSettings();

        $settings = json_decode($this->experimentSettings->setting ?? '{}', true, 512, JSON_THROW_ON_ERROR);

        $this->actions = $settings['actions'] ?? [];
        $this->fields = $settings['fields'] ?? [];
        $this->notifications = $settings['notifications'] ?? [];
    }

    public function render()
    {
        return view('livewire.experiment-settings.forms.create');
    }

    public function addAction(): void
    {
        $data = [
            'name' => '',
            'notify' => false,
            'notifyDays' => 1,
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
            'type' => 'number',
            'fields' => [],
        ];

        $this->fields[] = $data;
    }

    public function removeField(int $index): void
    {
        unset($this->fields[$index]);
    }

    public function addSubField(int $index): void
    {
        $this->fields[$index]['fields'][] = [
            'option' => '',
        ];
    }

    public function removeSubfield(int $fieldIndex, int $subfieldIndex): void
    {
        unset($this->fields[$fieldIndex]['fields'][$subfieldIndex]);
    }

    public function addNotification(): void
    {
        $data = [
            'actions' => null,
            'days' => 1,
        ];

        $this->notifications[] = $data;
    }

    public function removeNotification(int $index): void
    {
        unset($this->notifications[$index]);
    }

    /**
     * @throws \JsonException
     */
    public function save(InsertExperimentSettingsHandler $experimentSettingsHandler)
    {
        $validatedData = $this->validate();

        $experimentSettings = $experimentSettingsHandler->handle(new InsertExperimentSettingsCommand(
            $this->experiment,
            json_encode($validatedData['actions'], JSON_THROW_ON_ERROR),
            json_encode($validatedData['fields'], JSON_THROW_ON_ERROR),
            json_encode($validatedData['notifications'], JSON_THROW_ON_ERROR),
        ));

        return redirect()->route('experiment.edit', [$this->experiment->project, $this->experiment]);
    }
}
