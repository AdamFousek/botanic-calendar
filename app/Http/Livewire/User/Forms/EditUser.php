<?php

namespace App\Http\Livewire\User\Forms;

use App\Models\User;
use App\Queries\User\ViewUserByIdHandler;
use App\Queries\User\ViewUserByIdQuery;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use WithFileUploads;

    public int $userId;

    public string $firstName;

    public string $lastName;

    /** @var TemporaryUploadedFile */
    public $photo;

    public User $user;

    protected array $rules = [
        'firstName' => 'string|max:255',
        'lastName' => 'string|max:255',
        'photo' => 'nullable|image|max:1024',
    ];

    public function mount(ViewUserByIdHandler $viewUserByIdHandler): void
    {
        $user = $viewUserByIdHandler->handle(new ViewUserByIdQuery($this->userId));

        if ($user === null) {
            redirect()->route('dashboard');
        }

        $this->user = $user;
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
    }

    public function update()
    {
        $this->photo->storeAs('photos', '');
    }
}
