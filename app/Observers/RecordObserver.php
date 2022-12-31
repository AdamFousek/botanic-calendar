<?php

namespace App\Observers;

use App\Command\Record\RecalculateValuesCommand;
use App\Command\Record\RecalculateValuesHandler;
use App\Models\Record;

class RecordObserver
{
    public function __construct(
        private readonly RecalculateValuesHandler $recalculateValuesHandler,
    ) {
    }

    public function created(Record $record): void
    {
        if ($record->action->hasCalculated()) {
            $this->recalculateValuesHandler->handle(
                new RecalculateValuesCommand($record, $record)
            );

            return;
        }

        $parentRecord = $record->parent;
        if ($parentRecord->action->hasCalculated()) {
            $this->recalculateValuesHandler->handle(
                new RecalculateValuesCommand($parentRecord, $record)
            );

            return;
        }
    }

    /**
     * Handle the Record "updated" event.
     *
     * @param  \App\Models\Record  $record
     * @return void
     */
    public function updated(Record $record)
    {
        //
    }

    /**
     * Handle the Record "deleted" event.
     *
     * @param  \App\Models\Record  $record
     * @return void
     */
    public function deleted(Record $record)
    {
        //
    }

    /**
     * Handle the Record "restored" event.
     *
     * @param  \App\Models\Record  $record
     * @return void
     */
    public function restored(Record $record)
    {
        //
    }

    /**
     * Handle the Record "force deleted" event.
     *
     * @param  \App\Models\Record  $record
     * @return void
     */
    public function forceDeleted(Record $record)
    {
        //
    }
}
