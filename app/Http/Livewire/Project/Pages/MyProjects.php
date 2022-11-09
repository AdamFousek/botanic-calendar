<?php

namespace App\Http\Livewire\Project\Pages;

use App\Queries\Project\ViewProjectHandler;
use App\Queries\Project\ViewProjectQuery;
use App\Transformers\Models\ProjectTransformer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyProjects extends Component
{
    public int $userId;

    public string $searchText = '';

    public function render(
        ViewProjectHandler $viewProjectHandler,
        ProjectTransformer $projectTransformer
    ) {
        $userId = Auth::id();
        $search = trim($this->searchText);
        $projects = $viewProjectHandler->handle(new ViewProjectQuery(
            $userId,
            $search !== '' ? $search : null,
        ));

        sleep(2);

        return view('livewire.project.pages.my-projects', [
            'filteredProjects' => $projectTransformer->transformMulti($projects),
        ]);
    }
}
