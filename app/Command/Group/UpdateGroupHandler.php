<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;

class UpdateGroupHandler
{
    public function handle(UpdateGroupCommand $command): Group
    {
        $group = Group::find($command->groupId);

        $group->name = $command->name;
        $group->description = $command->description;
        $group->is_public = $command->isPublic;
        $group->save();

        return $group;
    }
}
