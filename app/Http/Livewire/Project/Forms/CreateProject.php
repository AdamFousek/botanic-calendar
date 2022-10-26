<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use Auth;
use Livewire\Component;
use Str;

class CreateProject extends Component
{
    public string $name = '';

    public bool $isPublic = false;

    public string $description = '';

    public ?int $groupId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'description' => 'nullable|string',
    ];

    public function create(InsertProjectHandler $insertProjectHandler)
    {
        $validatedData = $this->validate();

        $userId = Auth::id();
        $project = $insertProjectHandler->handle(new InsertProjectCommand(
            $userId,
            Str::uuid(),
            $validatedData['name'],
            $validatedData['isPublic'] ?? false,
            $validatedData['description'] ?? '',
            $this->groupId,
        ));

        return redirect()->route('projects.show', [$project]);
    }
}
