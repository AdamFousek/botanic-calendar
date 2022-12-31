<?php

namespace App\Http\Livewire\Record\Forms;

use App\Command\Record\InsertRecordCommand;
use App\Command\Record\InsertRecordHandler;
use App\Models\Experiment;
use App\Models\Record;
use App\Transformers\Models\ActionTransformer;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Record $record;

    public ?Record $parent = null;

    public ?int $actionId;

    public string $date;

    public array $values = [];

    public int $parentId = 0;

    protected $rules = [
        'parentId' => 'sometimes|integer',
        'date' => 'required|date',
        'actionId' => 'required|integer',
    ];

    public function mount(Experiment $experiment)
    {
        $this->authorize('create', [Record::class, $experiment]);

        $this->experiment = $experiment;
        $this->date = (new Carbon())->format('Y-m-d');
        $this->record = new Record();
        $this->actionId = $this->parent !== null ?
            $this->parent->action->subActions->first()?->id :
            $this->experiment->actions->first()?->id;
    }

    public function render(ActionTransformer $transformer)
    {
        $action = $this->resolveAction();
        if ($action !== null) {
            $this->values = $this->resolveValues($action);
            $transformedAction = $transformer->transform($action);
        }

        $data = [
            'transformedAction' => $transformedAction ?? [],
            'availableActions' => $this->parent !== null ? $this->parent->action->subActions : $this->experiment->actions,
        ];

        return view('livewire.record.forms.create', $data);
    }

    public function create(InsertRecordHandler $handler)
    {
        $this->authorize('create', [Record::class, $this->experiment]);

        $validated = $this->validate();

        $handler->handle(new InsertRecordCommand(
            $this->experiment,
            \DateTime::createFromFormat('Y-m-d', $validated['date']),
            $validated['actionId'],
            $this->values,
            $this->parent ?? null,
        ));

        return redirect()->route('experiment.show', [$this->experiment->project, $this->experiment]);
    }

    private function resolveAction(): ?Experiment\Action
    {
        if ($this->actionId === null) {
            return null;
        }

        foreach ($this->experiment->actions as $action) {
            if ((int) $this->actionId === $action->id) {
                return $action;
            }
        }

        return null;
    }

    private function resolveValues(Experiment\Action $action): array
    {
        $result = [];
        foreach ($action->fields as $field) {
            $result[$field['name']] = $this->values[$field['name']] ?? null;
        }

        return $result;
    }
}
