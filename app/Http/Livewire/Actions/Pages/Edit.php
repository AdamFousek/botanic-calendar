<?php

namespace App\Http\Livewire\Actions\Pages;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public Experiment\Action $action;

    public function mount(Experiment $experiment, Experiment\Action $action)
    {
        $this->authorize('update', $action);

        $this->experiment = $experiment;
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.actions.pages.edit');
    }
}
