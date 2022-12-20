<?php

declare(strict_types=1);

namespace App\Command\Record;

use App\Models\Experiment;
use App\Models\Record;

class InsertRecordHandler
{
    public function handle(InsertRecordCommand $command): Record
    {
        $record = new Record();
        $record->experiment_id = $command->experiment->id;
        $record->action_id = $command->actionId;
        $record->date = $command->date;
        $record->data = $this->resolveData($command);

        $record->save();

        return $record;
    }

    private function resolveData(InsertRecordCommand $data): array
    {
        $result = $data->data;
        $action = Experiment\Action::whereId($data->actionId)->first();
        if ($action === null) {
            return $data->data;
        }
        foreach ($action->fields as $field) {
            if ($field['type'] === Experiment\Action::TYPE_CALCULATED) {
                $result[$field['name']] = $this->calculateResult($data->experiment, $data->data, $field[Experiment\Action::TYPE_CALCULATED]);
            }
        }

        return $result;
    }

    private function calculateResult(Experiment $experiment, array $data, array $field): ?int
    {
        $from = 0;
        $to = 0;
        if ($field['fromAction'] === 0) {
            $from = (int) $data[$field['fromField']];
        } else {
            $action = $experiment->actions()->with('records')->whereId($field['fromAction'])->first();
            $records = $action->records;
            foreach ($records as $record) {
                $from += (int) $record->data[$field['fromField']];
            }
        }

        if ($field['action'] === 0) {
            $to = (int) $data[$field['field']];
        } else {
            $action = $experiment->actions()->with('records')->whereId($field['action'])->first();
            $records = $action->records;
            foreach ($records as $record) {
                $to += (int) $record->data[$field['field']];
            }
        }

        if ($field['operation'] === Experiment\Action::OPERATION_DIVISION && $to === 0) {
            return null;
        }

        return match ($field['operation']) {
            Experiment\Action::OPERATION_SUBTRACT => $from - $to,
            Experiment\Action::OPERATION_ADD => $from + $to,
            Experiment\Action::OPERATION_MULTIPLE => $from * $to,
            Experiment\Action::OPERATION_DIVISION => $from / $to,
        };
    }
}
