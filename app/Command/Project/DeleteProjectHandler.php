<?php

declare(strict_types=1);

namespace App\Command\Project;

class DeleteProjectHandler
{
    public function handle(DeleteProjectCommand $command): void
    {
        $command->project->delete();
    }
}
