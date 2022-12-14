<?php

namespace App\Http\Livewire\Actions\Pages;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Experiment\Action $action;

    public function mount(Experiment $experiment, Experiment\Action $action)
    {
        $this->authorize('createAction', $experiment);

        $this->experiment = $experiment;
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.actions.pages.create');
    }
}
