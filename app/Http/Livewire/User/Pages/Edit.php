<?php

namespace App\Http\Livewire\User\Pages;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $this->authorize('update', $this->user);

        return view('livewire.user.pages.edit');
    }
}
