<?php

declare(strict_types=1);

namespace App\Http\Controllers\Project;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\Project;
use App\Queries\Project\ViewProjectHandler;
use App\Queries\Project\ViewProjectQuery;
use App\Transformers\Models\GroupTransformer;
use App\Transformers\Models\ProjectTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function __construct(
        private readonly InsertProjectHandler $insertProjectHandler,
        private readonly ViewProjectHandler $viewProjectHandler,
        private readonly ProjectTransformer $projectTransformer,
        private readonly GroupTransformer $groupTransformer,
    ) {
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $userId = Auth::id();

        $projects = $this->viewProjectHandler->handle(new ViewProjectQuery(
            $userId,
            $search !== '' ? $search : null,
        ));

        $data = [
            'projects' => $this->projectTransformer->transformMulti($projects),
            'searchQuery' => $search,
        ];

        return view('pages.projects.index', $data);
    }

    public function create()
    {
        return view('pages.projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $userId = Auth::id();
        $project = $this->insertProjectHandler->handle(new InsertProjectCommand(
            $userId,
            (string) Str::uuid(),
            $validated['name'],
            $validated['is_public'] ?? false,
            $validated['description'] ?? '',
            $validated['groupId'] ?? null,
        ));

        return redirect()->route('pages.projects.show', [$project]);
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $group = [];
        if ($project->group !== null) {
            $group = $this->groupTransformer->transform($project->group);
        }

        $data = [
            'project' => $this->projectTransformer->transform($project),
            'group' => $group,
        ];

        return view('pages.projects.show', $data);
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $data = [
            'project' => $this->projectTransformer->transform($project),
        ];

        return view('pages.projects.edit', $data);
    }
}
