<?php

declare(strict_types=1);

namespace App\Queries\Project;

use App\Models\Project;

class ViewProjectByUuidHandler
{
    public function handle(ViewProjectByUUidQuery $query): ?Project
    {
        return Project::where(['uuid' => $query->getUuid()])->first();
    }
}
