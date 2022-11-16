<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class UpdateProjectHandler
{
    public function handle(UpdateProjectCommand $command): Project
    {
        $project = Project::find($command->getId());

        $project->name = $command->getName();
        $project->description = $command->getDescription();
        $project->is_public = $command->isPublic();

        $project->save();

        return $project;
    }
}
