<?php

declare(strict_types=1);

namespace App\Queries\Group;

use App\Models\Group;

class ViewGroupByUuidHandler
{
    public function handle(ViewGroupByUuidQuery $query): ?Group
    {
        return Group::where('uuid', $query->getUuid())->first();
    }
}
