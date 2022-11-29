<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function create(User $user, ?Group $group)
    {
        if ($group === null) {
            return Response::allow();
        }

        if ($group->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::deny(trans('You are not allowed to create a project'), 403);
    }

    public function view(User $user, Project $project): Response
    {
        if ($project->is_public) {
            return Response::allow();
        }

        if ($project->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::denyWithStatus(404);
    }

    public function update(User $user, Project $project): Response
    {
        if ($project->user->id === $user->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }

    public function delete(User $user, Project $project): Response
    {
        if ($project->user->id === $user->id) {
            return Response::allow();
        }

        return Response::denyWithStatus(403);
    }
}
