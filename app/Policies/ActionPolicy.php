<?php

namespace App\Policies;

use App\Models\Experiment\Action;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ActionPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Action $action): Response
    {
        if ($action->experiment->project->user_id === $user->id) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }

    public function update(User $user, Action $action): Response
    {
        if ($action->experiment->project->user_id === $user->id) {
            return Response::allow();
        }

        return Response::denyAsNotFound();
    }
}
