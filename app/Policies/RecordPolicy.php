<?php

namespace App\Policies;

use App\Models\Experiment;
use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RecordPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Experiment $experiment)
    {
        if ($experiment->project->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::deny();
    }

    public function create(User $user, Experiment $experiment): Response
    {
        if ($experiment->actions->count() === 0) {
            return Response::deny(trans('First you have to create or import actions for your experiment'));
        }

        if ($experiment->project->members->contains($user->id)) {
            return Response::allow();
        }

        return Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Record $record)
    {
        if ($record->experiment->project->user_id === $user->id) {
            return Response::allow();
        }

        return Response::deny();
    }

    public function delete(User $user, Record $record): Response
    {
        if ($record->experiment->project->user_id === $user->id) {
            return Response::allow();
        }

        return Response::deny();
    }
}
