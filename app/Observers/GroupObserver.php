<?php

namespace App\Observers;

use App\Models\Group;

class GroupObserver
{
    public bool $afterCommit = true;

    public function deleted(Group $group): void
    {
        $group->projects()->delete();
    }
}
