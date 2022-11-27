<?php

namespace App\Http\Controllers\Experiment;

use App\Http\Controllers\Controller;
use App\Models\Experiment;
use App\Models\Project;
use App\Transformers\Models\ExperimentTransformer;
use App\Transformers\Models\ProjectTransformer;

class ExperimentController extends Controller
{
    public function __construct(
        private readonly ProjectTransformer $projectTransformer,
        private readonly ExperimentTransformer $experimentTransformer,
    ) {
    }

    public function show(Project $project, Experiment $experiment)
    {
        $this->authorize('view', [$experiment, $project]);

        $data = [
            'project' => $this->projectTransformer->transform($project),
            'experiment' => $this->experimentTransformer->transform($experiment),
        ];

        return view('pages.experiment.show', $data);
    }

    public function edit(Experiment $experiment)
    {
        $this->authorize('update', $experiment);
    }
}
