<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;

class ViewUserByIdHandler
{
    public function handle(ViewUserByIdQuery $query): ?User
    {
        return User::where('id', $query->getId())->first();
    }
}
