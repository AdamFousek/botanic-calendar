<?php

namespace App\Http\Livewire\Experiment\Components;

use App\Models\Experiment;
use App\Models\Record;
use App\Queries\Helpers\OrderBy;
use App\Queries\Records\GetRecordsByExperimentHandler;
use App\Queries\Records\GetRecordsByExperimentQuery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Records extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public string $date = '';

    public ?int $actionId = null;

    public array $orderBy = [];

    public function mount()
    {
        $this->authorize('viewAny', [Record::class, $this->experiment]);

        $this->orderBy = [
            'field' => 'date',
            'desc' => false,
        ];
    }

    public function render(GetRecordsByExperimentHandler $handler)
    {
        $data = [
            'records' => $handler->handle(new GetRecordsByExperimentQuery(
                $this->experiment,
                $this->actionId === 0 ? null : $this->actionId,
                $this->date !== '' ? Carbon::createFromFormat('Y-m-d', $this->date) : null,
                new OrderBy($this->orderBy['field'], $this->orderBy['desc'])
            )),
        ];

        return view('livewire.experiment.components.records', $data);
    }

    public function changeOrder(string $field, bool $desc): void
    {
        $this->orderBy['field'] = $field;
        $this->orderBy['desc'] = $desc;
    }
}
