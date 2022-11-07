<?php

declare(strict_types=1);

namespace App\Repositories\Illuminate;

use App\Models\User;
use App\Queries\User\ViewGroupsQuery;
use App\Queries\User\ViewUserByIdQuery;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function getGroups(ViewGroupsQuery $query): Collection
    {
        $user = User::find($query->getUserId());

        return $user->memberGroups()->orderBy('is_admin', 'desc')->orderBy('created_at', 'desc')->get();
    }

    public function getById(ViewUserByIdQuery $query): ?User
    {
        return User::whereId($query->getId())->first();
    }
}
