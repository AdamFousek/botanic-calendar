<?php

namespace App\Http\Livewire\Actions\Forms;

use App\Models\Experiment\Action;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Delete extends Component
{
    use AuthorizesRequests;

    public int $actionId;

    public function delete()
    {
        $action = Action::whereId($this->actionId)->first();

        if ($action === null) {
            return;
        }

        $this->authorize('delete', $action);

        $experiment = $action->experiment;

        $action->delete();

        redirect()->route('experiment.edit', [$experiment->project, $experiment])
            ->with('success', trans('Action was deleted'));
    }
}
