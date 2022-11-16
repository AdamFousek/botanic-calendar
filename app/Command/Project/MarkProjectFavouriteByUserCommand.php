<?php

declare(strict_types=1);

namespace App\Command\Project;

use App\Models\Project;
use App\Models\User;

class MarkProjectFavouriteByUserCommand
{
    public function __construct(
        public readonly User $user,
        public readonly Project $project,
        public readonly bool $isFavourite,
    ) {
    }
}
