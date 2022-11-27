<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class InsertProjectHandler
{
    public function handle(InsertProjectCommand $command): Project
    {
        $project = new Project();
        $project->uuid = $command->uuid;
        $project->name = $command->name;
        $project->user_id = $command->userId;
        $project->description = $command->description;
        $project->group_id = $command->groupId;
        $project->save();

        $project->members()->attach($command->userId);

        return $project;
    }
}
