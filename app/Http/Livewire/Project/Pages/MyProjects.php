<?php

namespace App\Http\Livewire\Project\Pages;

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
        $userId = Auth::id();
        $search = trim($this->searchText);
        $projects = $viewProjectsHandler->handle(new ViewProjectsQuery(
            $userId,
            $search !== '' ? $search : null,
        ));

        return view('livewire.project.pages.my-projects', [
            'projects' => $projectTransformer->transformMulti($projects),
        ]);
    }
}
