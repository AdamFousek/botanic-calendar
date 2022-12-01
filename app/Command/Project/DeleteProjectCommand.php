<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class DeleteProjectCommand
{
    public function __construct(
        public readonly Project $project,
    ) {
    }
}
