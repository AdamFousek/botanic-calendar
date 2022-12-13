<?php

namespace App\Http\Livewire\Actions\Pages;

use App\Models\Experiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Experiment $experiment;

    public function mount(Experiment $experiment)
    {
        $this->authorize('createAction', $experiment);

        $this->experiment = $experiment;
    }

    public function render()
    {
        return view('livewire.actions.pages.create');
    }
}
