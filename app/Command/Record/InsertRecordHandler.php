<?php

declare(strict_types=1);

namespace App\Command\Record;

use App\Models\Record;

class InsertRecordHandler
{
    public function handle(InsertRecordCommand $command): Record
    {
        $record = new Record();
        $record->experimnet_id = $command->experiment;
        $record->action_id = $command->actionId;
        $record->date = $command->date;
        $record->data = $command->data;

        $record->save();

        return $record;
    }
}
