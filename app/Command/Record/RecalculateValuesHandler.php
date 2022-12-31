<?php

declare(strict_types=1);

namespace App\Command\Record;

class RecalculateValuesHandler
{
    public function handle(RecalculateValuesCommand $command): void
    {
        $calculatedFromRecord = $command->calculated;
        $newRecord = $command->newRecord;
    }

    public function calculate($fieldFrom, $fieldTo): float
    {
        return match ($fieldFrom['operation']) {
            Experiment\Action::OPERATION_SUBTRACT => $from - $to,
            Experiment\Action::OPERATION_ADD => $from + $to,
            Experiment\Action::OPERATION_MULTIPLE => $from * $to,
            Experiment\Action::OPERATION_DIVISION => $from / $to,
        };
    }
}
