<?php

namespace App\Http\Livewire\Actions\Forms;

use App\Command\Experiment\Actions\InsertExperimentActionsCommand;
use App\Command\Experiment\Actions\InsertExperimentActionsHandler;
use App\Http\Livewire\Actions\Forms\Helpers\FieldsTrait;
use App\Http\Livewire\Actions\Forms\Helpers\NotificationTrait;
use App\Models\Experiment;
use App\Transformers\Models\ActionTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    use FieldsTrait;
    use NotificationTrait;

    private const SELECT_OPERATIONS = [
        Experiment\Action::OPERATION_SUBTRACT => 'substract (-)',
        Experiment\Action::OPERATION_ADD => 'add (+)',
        Experiment\Action::OPERATION_MULTIPLE => 'multiple (*)',
        Experiment\Action::OPERATION_DIVISION => 'division (/)',
    ];

    public Experiment $experiment;

    public Experiment\Action $action;

    public ?Experiment\Action $parent = null;

    protected array $rules = [
        'action.name' => 'sometimes|required|string|max:255',
        'fields' => 'sometimes|array',
        'fields.*.name' => 'sometimes|required|string|max:255',
        'fields.*.type' => 'sometimes|required|in:text,datetime,number,select,calculated',
        'fields.*.options' => 'sometimes|array',
        'fields.*.options.*.option' => 'sometimes|required|string|max:255',
        'fields.*.calculating.operation' => 'sometimes|in:subtract,add,multiple,division',
        'fields.*.calculating.fromAction' => 'sometimes|integer',
        'fields.*.calculating.fromField' => 'sometimes|string|max:255',
        'fields.*.calculating.action' => 'sometimes|integer',
        'fields.*.calculating.field' => 'sometimes|string|max:255',
        'notifications' => 'sometimes|array',
        'notifications.*.days' => 'sometimes|required|int|min:1',
    ];

    public function mount()
    {
        $this->action = new Experiment\Action();
    }

    public function render(ActionTransformer $actionTransformer)
    {
        $data = [
            'selectOperations' => self::SELECT_OPERATIONS,
            'availableFieldsFrom' => $this->resolveAvailableFields($actionTransformer, 'fromAction'),
            'availableFields' => $this->resolveAvailableFields($actionTransformer, 'action'),
        ];

        return view('livewire.actions.forms.create', $data);
    }

    /**
     * @throws \JsonException
     */
    public function save(InsertExperimentActionsHandler $actionsHandler)
    {
        $validatedData = $this->validate();

        $fields = $this->resolveFields($validatedData['fields']);

        $action = $actionsHandler->handle(new InsertExperimentActionsCommand(
            $this->experiment,
            $this->action,
            $fields,
            $validatedData['notifications'],
            $this->parent ?? null,
        ));

        return redirect()->route('experiment.edit', [$this->experiment->project, $this->experiment]);
    }
}
