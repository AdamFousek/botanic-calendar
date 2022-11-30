<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;

class ViewGroupsQuery
{
    public function __construct(
        public readonly User $user,
        public readonly ?string $search,
    ) {
    }
}
