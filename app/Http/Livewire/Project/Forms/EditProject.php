<?php

namespace App\Http\Livewire\Project\Forms;

use App\Models\Project;
use Livewire\Component;

class EditProject extends Component
{
    public string $name;

    public bool $isPublic;

    public int $groupId;

    public string $description;

    public string $uuid;

    private int $projectId;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'description' => 'nullable|string',
    ];

    public function mount(Project $project): void
    {
        $this->projectId = $project->id;
        $this->name = $project->name;
        $this->uuid = $project->uuid;
        $this->isPublic = $project->is_public;
        $this->groupId = $project->group_id;
        $this->description = $project->description;
    }

    public function update()
    {
        $this->authorize('update', $this->projectId);

        $validatedData = $this->validate();

        dd($validatedData);
    }
}
