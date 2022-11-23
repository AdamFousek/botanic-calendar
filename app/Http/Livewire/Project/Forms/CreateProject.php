<?php

namespace App\Http\Livewire\Project\Forms;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use Auth;
use Livewire\Component;
use Str;

class CreateProject extends Component
{
    public string $projectName = '';

    public bool $isPublic = false;

    public string $projectDescription = '';

    public ?int $groupId = null;

    protected $rules = [
        'projectName' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'projectDescription' => 'nullable|string',
    ];

    public function create(InsertProjectHandler $insertProjectHandler)
    {
        $validatedData = $this->validate();

        $userId = Auth::id();
        $project = $insertProjectHandler->handle(new InsertProjectCommand(
            $userId,
            Str::uuid(),
            $validatedData['projectName'],
            $validatedData['isPublic'] ?? false,
            $validatedData['projectDescription'] ?? '',
            $this->groupId,
        ));

        return redirect()->route('projects.show', [$project]);
    }
}
