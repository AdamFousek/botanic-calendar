<?php

declare(strict_types=1);

namespace App\Queries\Group;

use App\Models\Group;
use Illuminate\Support\Collection;

class ViewGroupHandler
{
    public function handle(ViewGroupQuery $query): Collection
    {
        $builder = Group::query();

        $search = $query->getQuery();
        if ($search) {
            $builder::whereRaw("UPPER(name) LIKE '%".strtoupper($search)."%'");
        }

        $isPublic = $query->isPublic();
        if ($isPublic !== null) {
            $builder::where('is_public', $isPublic);
        }

        $builder->orderByQuery($query);

        return $builder::get();
    }
}
