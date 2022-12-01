<?php

namespace App\Http\Livewire\Project\Pages;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $this->authorize('view', $this->project);

        return view('livewire.project.pages.show');
    }
}
