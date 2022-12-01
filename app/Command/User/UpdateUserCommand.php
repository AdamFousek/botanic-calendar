<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Models\User;

class UpdateUserCommand
{
    public function __construct(
        public readonly User $user,
        public readonly string $photo,
    ) {
    }
}
