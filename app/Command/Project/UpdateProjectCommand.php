<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class UpdateProjectCommand
{
    public function __construct(
        public readonly Project $project,
        public readonly Collection $members,
        public readonly bool $allMembers,
    ) {
    }
}
