<?php

declare(strict_types=1);

namespace App\Command\Project;

class MarkProjectAsFavouriteByUserHandler
{
    public function handle(MarkProjectFavouriteByUserCommand $command)
    {
        if ($command->isFavourite) {
            $command->user->memberProjects()->updateExistingPivot($command->project->id, ['is_favourite' => false]);
        } else {
            $command->user->memberProjects()->updateExistingPivot($command->project->id, ['is_favourite' => true]);
        }
    }
}
