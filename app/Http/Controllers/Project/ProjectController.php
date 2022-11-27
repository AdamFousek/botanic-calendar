<?php

declare(strict_types=1);

namespace App\Http\Controllers\Project;

use App\Command\Project\InsertProjectHandler;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Transformers\Helpers\MembersTransformer;
use App\Transformers\Models\ExperimentTransformer;
use App\Transformers\Models\GroupTransformer;
use App\Transformers\Models\ProjectTransformer;

class ProjectController extends Controller
{
    public function __construct(
        private readonly InsertProjectHandler $insertProjectHandler,
        private readonly MembersTransformer $membersTransformer,
        private readonly ProjectTransformer $projectTransformer,
        private readonly GroupTransformer $groupTransformer,
        private readonly ExperimentTransformer $experimentTransformer,
    ) {
    }

    public function index()
    {
        return view('pages.projects.index');
    }

    public function create()
    {
        return view('pages.projects.create');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $group = [];
        if ($project->group !== null) {
            $group = $this->groupTransformer->transform($project->group);
        }

        $members = $project->members;

        $data = [
            'project' => $this->projectTransformer->transform($project),
            'members' => $this->membersTransformer->transform($members),
            'group' => $group,
            'experiments' => $this->experimentTransformer->transformMulti($project->experiments),
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
