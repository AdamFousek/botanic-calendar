<?php

namespace App\Http\Livewire\Actions\Forms;

use App\Command\Experiment\Actions\InsertExperimentActionsCommand;
use App\Command\Experiment\Actions\InsertExperimentActionsHandler;
use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Experiment\Action $action;

    public ?Experiment\Action $parent;

    public array $fields = [];

    public array $notifications = [];

    public array $operations = [];

    protected array $rules = [
        'action.name' => 'sometimes|required|string|max:255',
        'fields' => 'sometimes|array',
        'fields.*.name' => 'sometimes|required|string|max:255',
        'fields.*.type' => 'sometimes|required|in:text,datetime,number,select',
        'fields.*.options' => 'sometimes|array',
        'fields.*.options.*.name' => 'sometimes|required|string|max:255',
        'notifications' => 'sometimes|array',
        'notifications.*.days' => 'sometimes|required|int|min:1',
        'operations' => 'sometimes|array',
        'operations.*.operation' => 'sometimes|required|in:subtract,add,multiple,division',
        'operations.*.fromField' => 'sometimes|required|string|max:255',
        'operations.*.field' => 'sometimes|required|string|max:255',
    ];

    public function mount()
    {
        $this->action = new Experiment\Action();
    }

    public function render()
    {
        return view('livewire.actions.forms.create');
    }

    public function addOperation(): void
    {
        $data = [
            'operation' => 'subtract',
            'fromField' => '',
            'field' => '',
        ];

        $this->operations = $data;
    }

    public function removeOperation(int $index): void
    {
        unset($this->operations[$index]);
    }

    public function addField(): void
    {
        $data = [
            'name' => '',
            'type' => 'number',
            'options' => [],
        ];

        $this->fields[] = $data;
    }

    public function removeField(int $index): void
    {
        unset($this->fields[$index]);
    }

    public function addSubField(int $index): void
    {
        $this->fields[$index]['options'][] = [
            'option' => '',
        ];
    }

    public function removeSubfield(int $fieldIndex, int $subfieldIndex): void
    {
        unset($this->fields[$fieldIndex]['options'][$subfieldIndex]);
    }

    public function addNotification(): void
    {
        $data = [
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
    public function save(InsertExperimentActionsHandler $actionsHandler)
    {
        $validatedData = $this->validate();

        $action = $actionsHandler->handle(new InsertExperimentActionsCommand(
            $this->experiment,
            $this->action,
            json_encode($validatedData['actions'], JSON_THROW_ON_ERROR),
            json_encode($validatedData['fields'], JSON_THROW_ON_ERROR),
            json_encode($validatedData['notifications'], JSON_THROW_ON_ERROR),
            $this->parent,
        ));

        return redirect()->route('experiment.edit', [$this->experiment->project, $this->experiment]);
    }
}
