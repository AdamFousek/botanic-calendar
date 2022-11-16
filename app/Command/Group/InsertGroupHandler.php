<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;

class InsertGroupHandler
{
    public function handle(InsertGroupCommand $command): Group
    {
        $group = new Group();
        $group->uuid = $command->getUuid();
        $group->name = $command->getName();
        $group->description = $command->getDescription();
        $group->user_id = $command->getAuthorId();
        $group->is_public = $command->isPublic();
        $group->save();

        $group->members()->attach($command->getAuthorId(), ['is_admin' => 1]);

        return $group;
    }
}
