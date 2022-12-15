<?php

namespace App\Http\Livewire\Actions\Forms;

use App\Command\Experiment\Actions\UpdateExperimentActionCommand;
use App\Command\Experiment\Actions\UpdateExperimentActionHandler;
use App\Http\Livewire\Actions\Forms\Helpers\FieldsTrait;
use App\Http\Livewire\Actions\Forms\Helpers\NotificationTrait;
use App\Models\Experiment;
use App\Transformers\Models\ActionTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    use FieldsTrait;
    use NotificationTrait;

    private const SELECT_OPERATIONS = [
        'subtract' => 'substract (-)',
        'add' => 'add (+)',
        'multiple' => 'multiple (*)',
        'division' => 'division (/)',
    ];

    public Experiment $experiment;

    public Experiment\Action $action;

    public ?Experiment\Action $parent;

    protected array $rules = [
        'action.name' => 'sometimes|required|string|max:255',
        'fields' => 'sometimes|array',
        'fields.*.name' => 'sometimes|required|string|max:255',
        'fields.*.type' => 'sometimes|required|in:text,datetime,number,select,calculated',
        'fields.*.options' => 'sometimes|array',
        'fields.*.options.*.option' => 'sometimes|required|string|max:255',
        'fields.*.calculated.operation' => 'sometimes|in:subtract,add,multiple,division',
        'fields.*.calculated.actionFrom' => 'sometimes|integer',
        'fields.*.calculated.fromField' => 'sometimes|string|max:255',
        'fields.*.calculated.action' => 'sometimes|integer',
        'fields.*.calculated.field' => 'sometimes|string|max:255',
        'notifications' => 'sometimes|array',
        'notifications.*.days' => 'sometimes|required|int|min:1',
    ];

    public function mount(ActionTransformer $actionTransformer)
    {
        $this->authorize('update', $this->action);

        $transformedAction = $actionTransformer->transform($this->action);
        $this->fields = $transformedAction['fields'];
        $this->notifications = $transformedAction['notifications'];
    }

    public function render(ActionTransformer $actionTransformer)
    {
        $data = [
            'selectOperations' => self::SELECT_OPERATIONS,
            'availableFieldsFrom' => $this->resolveAvailableFields($actionTransformer, 'fromAction'),
            'availableFields' => $this->resolveAvailableFields($actionTransformer, 'action'),
        ];

        return view('livewire.actions.forms.edit', $data);
    }

    /**
     * @throws \JsonException
     */
    public function update(UpdateExperimentActionHandler $updateExperimentActionHandler)
    {
        $validatedData = $this->validate();

        $fields = $this->resolveFields($validatedData['fields']);

        $action = $updateExperimentActionHandler->handle(new UpdateExperimentActionCommand(
            $this->experiment,
            $this->action,
            json_encode($fields, JSON_THROW_ON_ERROR),
            json_encode($validatedData['notifications'], JSON_THROW_ON_ERROR),
        ));

        return redirect()->route('experiment.edit', [$this->experiment->project, $this->experiment]);
    }

    private function resolveFields(array $fields)
    {
        foreach ($fields as $field) {
            if ($field['type'] !== 'calculated') {
                $field['calculated'] = [];
            }
        }

        return $fields;
    }
}
