<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;
use Illuminate\Support\Str;

class InsertGroupHandler
{
    public function handle(InsertGroupCommand $command): Group
    {
        $group = $command->group;
        $group->uuid = Str::uuid();
        $group->user_id = $command->user->id;
        $group->description = $group->description ?? '';
        $group->save();

        $group->members()->attach($command->user->id, ['is_admin' => 1]);

        return $group;
    }
}
