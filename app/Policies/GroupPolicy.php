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
        if ($group->is_public) {
            return Response::allow();
        }

        if ($group->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::denyWithStatus(404);
    }

    public function update(User $user, Group $group): Response
    {
        if ($group->user_id === $user->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }

    public function delete(User $user, Group $group): Response
    {
        if ($user->id === $group->user_id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }

    public function inviteMember(User $user, Group $group): Response
    {
        if ($user->id === $group->user->id) {
            return Response::allow();
        }

        if ($group->is_public && $group->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }
}
