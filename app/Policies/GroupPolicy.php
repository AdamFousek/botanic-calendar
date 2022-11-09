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

    public function view(User $user, Group $group): Response
    {
        if ($group->user->id === $user->id) {
            return Response::allow();
        }

        if ($group->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }

    public function create(User $user)
    {
        //
    }

    public function edit(User $user, Group $group)
    {
        if ($group->user_id === $user->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }

    public function delete(User $user, Group $group)
    {
        if ($group->members->count() === 0) {
            return Response::denyWithStatus(403, trans('Group still has members'));
        }

        if ($group->projects->count() === 0) {
            return Response::denyWithStatus(403, trans('Group still has projects'));
        }

        if ($user->id === $group->user_id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }

    public function inviteMember(User $user, Group $group)
    {
        if ($group->is_public) {
            if ($group->members->contains($user->id)) {
                return Response::allow();
            }

            return Response::denyWithStatus(403);
        }

        if ($user->id === $group->user->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }
}
