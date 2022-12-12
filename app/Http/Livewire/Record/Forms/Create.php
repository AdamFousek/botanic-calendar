<?php

namespace App\Http\Livewire\Record\Forms;

use App\Models\Experiment;
use App\Models\Record;
use App\Transformers\Models\ExperimentSettingsTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Record $record;

    public string $date;

    public array $values;

    protected $rules = [
        'date' => 'required|date',
        'record.action' => 'required',
    ];

    public function mount(Experiment $experiment, ExperimentSettingsTransformer $transformer)
    {
        $this->authorize('create', [Record::class, $experiment]);

        $this->experiment = $experiment;
        $transformedSettings = $transformer->transform($this->experiment->settings);

        if ($transformedSettings === null) {
            return null;
        }

        foreach ($transformedSettings->fields as $field) {
            $this->values[$field['name']] = ['value' => ''];
        }

        $this->record = new Record();
    }

    public function render(ExperimentSettingsTransformer $transformer)
    {
        $data = [
            'transformedSettings' => $transformer->transform($this->experiment->settings),
        ];

        return view('livewire.record.forms.create', $data);
    }

    public function create()
    {
    }
}
