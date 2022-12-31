<?php

declare(strict_types=1);

namespace App\Command\Record;

use App\Models\Record;

class RecalculateValuesCommand
{
    public function __construct(
        public readonly Record $calculated,
        public readonly Record $newRecord,
    ) {
    }
}
