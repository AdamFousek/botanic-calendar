<?php

declare(strict_types=1);

namespace App\Command\Group;

use App\Models\Group;
use App\Models\User;

class ToggleFavouriteGroupCommand
{
    public function __construct(
        public readonly User $user,
        public readonly Group $group,
        public readonly bool $isFavourite,
    ) {
    }
}
