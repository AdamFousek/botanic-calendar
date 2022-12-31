<?php

declare(strict_types=1);

namespace App\Queries\Records;

class GetRecordsByExperimentHandler
{
    public function handle(GetRecordsByExperimentQuery $query)
    {
        $qb = $query->experiment->records();

        if ($query->actionId !== null) {
            $qb->where('action_id', $query->actionId);
        }

        if ($query->date !== null) {
            $startOfDay = clone $query->date->startOfDay();
            $endOfDay = $query->date->addDay();
            $qb->where('date', '>', $startOfDay);
            $qb->where('date', '<', $endOfDay);
        }

        if ($query->orderBy !== null) {
            $dir = $query->orderBy->isDesc() ? 'desc' : 'asc';
            $qb->orderBy($query->orderBy->getField(), $dir);
        }

        return $qb->get();
    }
}
