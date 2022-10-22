<?php

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\InsertGroupCommand;
use App\Command\Group\InsertGroupHandler;
use Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateGroup extends Component
{
    public string $name = '';

    public bool $isPublic = false;

    public string $description = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'description' => 'nullable|string',
    ];

    public function save(InsertGroupHandler $insertGroupHandler)
    {
        $validatedData = $this->validate();

        $userId = Auth::id();
        $group = $insertGroupHandler->handle(new InsertGroupCommand(
            $validatedData['name'],
            Str::uuid(),
            $validatedData['isPublic'] ?? false,
            $validatedData['description'] ?? '',
            $userId,
        ));

        return redirect()->route('groups.show', [$group]);
    }
}
