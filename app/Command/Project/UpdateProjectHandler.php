<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class UpdateProjectHandler
{
    public function handle(UpdateProjectCommand $command): Project
    {
        $project = $command->project;
        $project->save();

        if ($command->allMembers) {
            $members = $command->project->group->members;
        } else {
            $members = $command->members;
        }

        $project->members()->sync($members);

        return $project;
    }
}
