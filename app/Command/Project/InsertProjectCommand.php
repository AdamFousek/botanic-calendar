<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class InsertProjectCommand
{
    public function __construct(
        public readonly Project $project,
        public readonly User $user,
        public readonly Collection $members,
        public readonly bool $allMembers,
        public readonly ?Group $group,
    ) {
    }
}
