<?php

declare(strict_types=1);

namespace App\Command\Experiment\Actions;

class UpdateExperimentActionHandler
{
    public function handle(UpdateExperimentActionCommand $command)
    {
        $action = $command->action;
        $action->fields = $command->fields;
        $action->notifications = $command->notifications;
        $action->parent_id = $action->parent_id === '' ? null : $action->parent_id;

        $action->save();

        return $action;
    }
}
