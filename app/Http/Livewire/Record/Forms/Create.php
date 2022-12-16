<?php

namespace App\Http\Livewire\Record\Forms;

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
            // $this->values = $this->resolveValues($action);
            $transformedAction = $transformer->transform($action);
        }

        $data = [
            'transformedAction' => $transformedAction ?? [],
        ];

        return view('livewire.record.forms.create', $data);
    }

    public function create()
    {
        $this->authorize('create', [Record::class, $this->experiment]);

        $validated = $this->validate();

        dd($validated);
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
        foreach ($action->fields as $field) {
            if ($field['type'] === Experiment\Action::TYPE_CALCULATED) {
                continue;
            }
        }

        return [];
    }
}
