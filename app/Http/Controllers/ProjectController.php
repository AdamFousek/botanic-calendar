<?php

namespace App\Http\Controllers;

use App\Command\Project\InsertProject;
use App\Command\Project\InsertProjectHandler;
use App\Command\Project\ViewProject;
use App\Command\Project\ViewProjectHandler;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function __construct(
        private readonly InsertProjectHandler $insertProjectHandler,
        private readonly ViewProjectHandler $viewProjectHandler,
    )
    {

    }

    public function myProjects(Request $request)
    {
        $search = $request->query('search', '');
        $userId = Auth::id();

        $projects = $this->viewProjectHandler->handle(new ViewProject(
            $userId,
            $search !== '' ? $search : null,
        ));

        $data = [
            'projects' => $projects,
            'searchQuery' => $search,
        ];

        return view('projects.myProjects', $data);
    }

    public function allProjects(Request $request)
    {
        $search = $request->query('search', '');

        $projects = $this->viewProjectHandler->handle(new ViewProject(
            searchQuery: $search !== '' ? $search : null,
            isPublic: true,
        ));

        $data = [
            'projects' => $projects,
            'searchQuery' => $search,
        ];

        return view('projects.allProjects', $data);
    }


    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        $project = $this->insertProjectHandler->handle(new InsertProject(
            $user,
            Str::uuid(),
            $validated['name'],
            $validated['is_public'] ?? false,
            $validated['description'] ?? ''
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
