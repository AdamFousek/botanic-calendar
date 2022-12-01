<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;
use Illuminate\Support\Str;

class InsertProjectHandler
{
    public function handle(InsertProjectCommand $command): Project
    {
        $project = $command->project;
        $project->uuid = Str::uuid();
        $project->user_id = $command->user->id;
        $project->group_id = $command->group?->id;
        $project->save();

        if ($command->group) {
            if ($command->allMembers) {
                $members = $project->group->members;
            } else {
                $members = $command->members;
            }

            $project->members()->sync($members);
        }

        $project->members()->syncWithoutDetaching([$command->user->id]);

        return $project;
    }
}
