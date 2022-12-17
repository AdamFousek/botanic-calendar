<?php

declare(strict_types=1);

namespace App\Command\Record;

use App\Models\Experiment;

class InsertRecordCommand
{
    public function __construct(
        public readonly Experiment $experiment,
        public readonly \DateTime $date,
        public readonly int $actionId,
        public readonly array $data,
    ) {
    }
}
