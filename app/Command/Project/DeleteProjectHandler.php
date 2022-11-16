<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;

class DeleteProjectHandler
{
    public function handle(DeleteProjectCommand $command): void
    {
        Project::where('uuid', $command->getUuid())->delete();
    }
}
