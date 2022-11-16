<?php

declare(strict_types=1);

namespace App\Command\Project;

class MarkProjectAsFavouriteByUserHandler
{
    public function handle(MarkProjectFavouriteByUserCommand $command)
    {
        if ($command->isFavourite) {
            $command->user->favouriteProjects()->detach($command->project->id);
        } else {
            $command->user->favouriteProjects()->attach($command->project->id);
        }
    }
}
