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
        'action.name' => 'required|string|max:255',
        'action.parent_id' => 'nullable|exists:actions,id',
        'fields' => 'sometimes|array',
        'fields.*.name' => 'sometimes|required|string|max:255',
        'fields.*.type' => 'sometimes|required|in:text,datetime,number,select,operation',
        'fields.*.options' => 'sometimes|array',
        'fields.*.options.*.option' => 'sometimes|required|string|max:255',
        'fields.*.operations' => 'sometimes|array',
        'fields.*.operations.*.operation' => 'sometimes|required|in:subtract,add,multiple,division',
        'fields.*.operations.*.fromField' => 'sometimes|required|string|max:255',
        'fields.*.operations.*.field' => 'sometimes|required|string|max:255',
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
            'availableFields' => $this->resolveAvailableFields($actionTransformer),
        ];

        return view('livewire.actions.forms.edit', $data);
    }

    /**
     * @throws \JsonException
     */
    public function update(UpdateExperimentActionHandler $updateExperimentActionHandler)
    {
        $validatedData = $this->validate();

        $action = $updateExperimentActionHandler->handle(new UpdateExperimentActionCommand(
            $this->experiment,
            $this->action,
            json_encode($validatedData['fields'], JSON_THROW_ON_ERROR),
            json_encode($validatedData['notifications'], JSON_THROW_ON_ERROR),
        ));

        return redirect()->route('experiment.edit', [$this->experiment->project, $this->experiment]);
    }

    private function resolveAvailableFields(ActionTransformer $actionTransformer): array
    {
        $availableFields = [];
        foreach ($this->fields as $field) {
            if ($field['type'] === 'number') {
                $availableFields[$field['name']] = $field['name'];
            }
        }

        $parent = Experiment\Action::whereId($this->action->parent_id)->first();
        if ($parent === null) {
            return $availableFields;
        }

        $transformedParent = $actionTransformer->transform($parent);
        foreach ($transformedParent['fields'] as $field) {
            if ($field['type'] === 'number') {
                $availableFields[$parent->id.$field['name']] = $parent->name.' - '.$field['name'];
            }
        }

        return $availableFields;
    }
}
