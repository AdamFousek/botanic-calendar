<?php

namespace App\Http\Controllers;

use App\Command\Project\InsertProjectCommand;
use App\Command\Project\InsertProjectHandler;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Queries\Project\ViewProjectHandler;
use App\Queries\Project\ViewProjectQuery;
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

        return view('projects.index', $data);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $userId = Auth::id();
        $project = $this->insertProjectHandler->handle(new InsertProjectCommand(
            $userId,
            Str::uuid(),
            $validated['name'],
            $validated['is_public'] ?? false,
            $validated['description'] ?? '',
            $validated['groupId'] ?? null,
        ));

        return redirect()->route('projects.show', [$project]);
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Project\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
