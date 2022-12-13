<?php

declare(strict_types=1);

namespace App\Command\Experiment\Actions;

use App\Models\Experiment\Action;

class InsertExperimentActionsHandler
{
    public function handle(InsertExperimentActionsCommand $command): Action
    {
        $action = $command->action;
        $action->experiment_id = $command->experiment->id;
        $action->fields = $command->fields;
        $action->operations = $command->operations;
        $action->notifications = $command->notifications;
        $action->parent_id = $command->parent?->id;

        $action->save();

        return $action;
    }
}
