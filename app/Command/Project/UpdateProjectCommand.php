<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class UpdateProjectCommand
{
    public function __construct(
        public readonly Project $project,
        public readonly array $members,
        public readonly bool $allMembers,
    ) {
    }
}
