<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    public function created(Project $project): void
    {
        $group = $project->group;

        if ($group !== null) {
            // @todo send notification to owner of group about new project
        }
    }

    public function updated(Project $project)
    {
        //
    }

    public function deleted(Project $project): void
    {
        $project->experiments()->delete();
    }
}
