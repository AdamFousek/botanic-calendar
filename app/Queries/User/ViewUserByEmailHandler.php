<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;

class ViewUserByEmailHandler
{
    public function handle(ViewUserByEmailQuery $command): ?User
    {
        return User::where('email', $command->getEmail())->first();
    }
}
