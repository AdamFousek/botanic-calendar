<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavouriteProjects extends Component
{
    public function render()
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect('login');
        }

        $data = [
            'favouriteProjects' => $user->favouriteProjects,
        ];

        return view('livewire.dashboard.favourite-projects', $data);
    }
}
