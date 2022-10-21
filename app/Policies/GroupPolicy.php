<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Group $group): Response
    {
        if ($group->user->id === $user->id) {
            return Response::allow();
        }

        if ($group->users->find($user->id)) {
            return Response::allow();
        }

        return Response::denyWithStatus(404);
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Group $group)
    {
        //
    }

    public function delete(User $user, Group $group)
    {
        //
    }

    public function restore(User $user, Group $group)
    {
        //
    }

    public function forceDelete(User $user, Group $group)
    {
        //
    }

    public function inviteMember(User $user, Group $group)
    {
        if ($user->id === $group->user->id) {
            return true;
        }

        return false;
    }
}
