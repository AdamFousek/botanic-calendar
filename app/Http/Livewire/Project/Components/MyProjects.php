<?php

namespace App\Http\Livewire\Project\Components;

use App\Models\Project;
use App\Queries\User\ViewProjectsHandler;
use App\Queries\User\ViewProjectsQuery;
use App\Transformers\Models\ProjectTransformer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyProjects extends Component
{
    public string $searchText = '';

    public function render(
        ViewProjectsHandler $viewProjectsHandler,
        ProjectTransformer $projectTransformer
    ) {
        $user = Auth::user();
        if ($user === null) {
            return redirect('welcome');
        }

        $search = trim($this->searchText);
        $projects = $viewProjectsHandler->handle(new ViewProjectsQuery(
            $user->id,
            $search !== '' ? $search : null,
        ));

        [$favouriteProjects, $projects] = $projects->partition(function (Project $project) {
            return $project->pivot->is_favourite;
        });

        return view('livewire.project.components.my-projects', [
            'favouriteProjects' => $favouriteProjects,
            'projects' => $projects,
        ]);
    }
}
