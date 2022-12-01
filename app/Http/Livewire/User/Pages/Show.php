<?php

namespace App\Http\Livewire\User\Pages;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $data = [
            'user' => $this->user,
        ];

        return view('livewire.user.pages.show', $data);
    }
}
