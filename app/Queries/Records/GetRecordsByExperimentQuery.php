<?php

declare(strict_types=1);

namespace App\Queries\Records;

use App\Models\Experiment;
use App\Queries\Helpers\OrderBy;
use Illuminate\Support\Carbon;

class GetRecordsByExperimentQuery
{
    public function __construct(
        public readonly Experiment $experiment,
        public readonly ?int $actionId = null,
        public readonly ?Carbon $date = null,
        public readonly ?OrderBy $orderBy = null,
    ) {
    }
}
