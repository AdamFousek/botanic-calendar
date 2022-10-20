<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }
}
