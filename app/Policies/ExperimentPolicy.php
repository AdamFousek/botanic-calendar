<?php

namespace App\Policies;

use App\Models\Experiment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExperimentPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Project $project): Response
    {
        if ($project->user_id === $user->id) {
            return Response::allow();
        }

        if ($project->users()->contains($user->id)) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }

    public function view(User $user, Experiment $experiment, Project $project): Response
    {
        if ($project->user_id === $user->id) {
            return Response::allow();
        }

        if ($experiment->users()->contains($user->id)) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }

    public function update(User $user, Experiment $experiment): Response
    {
        if ($experiment->user_id !== $user->id) {
            return Response::denyAsNotFound();
        }

        return Response::allow();
    }

    public function delete(User $user, Experiment $experiment): Response
    {
        if ($experiment->user_id !== $user->id) {
            return Response::denyAsNotFound();
        }

        return Response::allow();
    }
}
