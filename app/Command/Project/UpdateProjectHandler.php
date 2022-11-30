<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class UpdateProjectHandler
{
    public function handle(UpdateProjectCommand $command): Project
    {
        $project = Project::find($command->id);

        $project->name = $command->name;
        $project->description = $command->description;
        $project->is_public = $command->isPublic;
        $project->members()->sync($command->members);

        $project->save();

        return $project;
    }
}
