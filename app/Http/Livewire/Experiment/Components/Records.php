<?php

namespace App\Http\Livewire\Experiment\Components;

use App\Models\Experiment;
use App\Models\Record;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jenssegers\Mongodb\Collection;
use Livewire\Component;

class Records extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Collection $records;

    public function mount()
    {
        $this->authorize('viewAny', [Record::class, $this->experiment]);

        $this->records = $this->experiment->records;
    }

    public function render()
    {
        return view('livewire.experiment.components.records');
    }
}
