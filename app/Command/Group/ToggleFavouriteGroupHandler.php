<?php

declare(strict_types=1);

namespace App\Command\Group;

class ToggleFavouriteGroupHandler
{
    public function handle(ToggleFavouriteGroupCommand $command)
    {
        if ($command->isFavourite) {
            $command->user->memberGroups()->updateExistingPivot($command->group->id, ['is_favourite' => false]);
        } else {
            $command->user->memberGroups()->updateExistingPivot($command->group->id, ['is_favourite' => true]);
        }
    }
}
