<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model): Response
    {
        if ($user->id === $model->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(404);
    }

    public function delete(User $user, User $model)
    {
        if ($user->id === $model->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }
}
