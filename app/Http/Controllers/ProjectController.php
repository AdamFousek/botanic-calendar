<?php

namespace App\Http\Controllers;

use App\Command\Project\InsertProject;
use App\Command\Project\InsertProjectHandler;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function __construct(
        private InsertProjectHandler $insertProjectHandler,
    )
    {

    }

    public function index()
    {

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
            $validate['is_public'] ?? false
        ));

        return redirect()->route('projects.show', [$project]);
    }

    public function show(Project $project)
    {
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
