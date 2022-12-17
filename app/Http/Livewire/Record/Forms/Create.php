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

    public string $date;

    public array $values = [];

    protected $rules = [
        'date' => 'required|date',
        'record.action' => 'required|integer',
    ];

    public function mount(Experiment $experiment)
    {
        $this->authorize('create', [Record::class, $experiment]);

        $this->experiment = $experiment;
        $this->date = (new Carbon())->format('Y-m-d');
        $this->record = new Record();
        $this->record->action = $this->experiment->actions->first()->id;
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
            $validated['record']['action'],
            $this->values,
        ));

        return redirect()->route('experiment.show', [$this->experiment->project, $this->experiment]);
    }

    private function resolveAction(): ?Experiment\Action
    {
        if ($this->record->action === null) {
            return null;
        }

        foreach ($this->experiment->actions as $action) {
            if ((int) $this->record->action === $action->id) {
                return $action;
            }
        }

        return null;
    }

    private function resolveValues(Experiment\Action $action): array
    {
        $result = [];
        foreach ($action->fields as $field) {
            if ($field['type'] === Experiment\Action::TYPE_CALCULATED) {
                continue;
            }

            $result[$field['name']] = $this->values[$field['name']] ?? null;
        }

        return $result;
    }
}
