<?php

declare(strict_types=1);

namespace App\Command\Experiment;

use App\Models\ExperimentSettings;

class InsertExperimentSettingsHandler
{
    public function handle(InsertExperimentSettingsCommand $command): ExperimentSettings
    {
        $experiment = $command->experiment;
        $experimentSettings = $experiment->settings ?? new ExperimentSettings();
        $experimentSettings->setting = json_encode([
            'actions' => $command->actions,
            'fields' => $command->fields,
            'notifications' => $command->notifications,
        ], JSON_THROW_ON_ERROR);

        if ($experiment->settings === null) {
            $experimentSettings->experiment()->associate($experiment);
        }
        $experimentSettings->save();

        return $experimentSettings;
    }
}
