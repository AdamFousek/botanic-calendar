<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\ExperimentSettings;
use App\Transformers\Dto\ExperimentSettingsDto;

class ExperimentSettingsTransformer
{
    public function transform(?ExperimentSettings $experimentSettings): ?ExperimentSettingsDto
    {
        if ($experimentSettings === null) {
            return null;
        }

        $decodedData = json_decode($experimentSettings->setting, true, 512, JSON_THROW_ON_ERROR);

        return new ExperimentSettingsDto(
            json_decode($decodedData['actions'], true, 512, JSON_THROW_ON_ERROR),
            json_decode($decodedData['fields'], true, 512, JSON_THROW_ON_ERROR),
            json_decode($decodedData['notifications'], true, 512, JSON_THROW_ON_ERROR),
        );
    }
}
