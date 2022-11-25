<?php

namespace App\Http\Livewire\Group\Forms;

use App\Command\Group\InsertGroupCommand;
use App\Command\Group\InsertGroupHandler;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateGroup extends Component
{
    public string $groupName = '';

    public bool $isPublic = false;

    public string $groupDescription = '';

    protected $rules = [
        'groupName' => 'required|string|max:255',
        'isPublic' => 'nullable',
        'groupDescription' => 'nullable|string',
    ];

    public function create(InsertGroupHandler $insertGroupHandler)
    {
        $validatedData = $this->validate();

        $user = Auth::user();
        if (! $user instanceof User) {
            return redirect()->route('welcome');
        }

        $group = $insertGroupHandler->handle(new InsertGroupCommand(
            $validatedData['groupName'],
            (string) Str::uuid(),
            $validatedData['isPublic'] ?? false,
            $validatedData['groupDescription'] ?? '',
            $user->id,
        ));

        return redirect()->route('groups.show', [$group]);
    }
}
