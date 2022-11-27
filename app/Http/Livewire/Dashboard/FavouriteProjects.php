<?php

namespace App\Http\Livewire\Dashboard;

use App\Transformers\Models\ProjectTransformer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavouriteProjects extends Component
{
    public function render(ProjectTransformer $projectTransformer)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect('welcome');
        }

        $projects = $user->favouriteProjects();

        $data = [
            'favouriteProjects' => $projectTransformer->transformMulti($projects),
        ];

        return view('livewire.dashboard.favourite-projects', $data);
    }
}
