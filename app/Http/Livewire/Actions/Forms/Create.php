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
        'subtract' => 'substract (-)',
        'add' => 'add (+)',
        'multiple' => 'multiple (*)',
        'division' => 'division (/)',
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
        'fields.*.calculated.operation' => 'sometimes|in:subtract,add,multiple,division',
        'fields.*.calculated.actionFrom' => 'sometimes|integer',
        'fields.*.calculated.fromField' => 'sometimes|string|max:255',
        'fields.*.calculated.action' => 'sometimes|integer',
        'fields.*.calculated.field' => 'sometimes|string|max:255',
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

        $action = $actionsHandler->handle(new InsertExperimentActionsCommand(
            $this->experiment,
            $this->action,
            json_encode($validatedData['fields'], JSON_THROW_ON_ERROR),
            json_encode($validatedData['notifications'], JSON_THROW_ON_ERROR),
            $this->parent ?? null,
        ));

        return redirect()->route('experiment.edit', [$this->experiment->project, $this->experiment]);
    }
}
