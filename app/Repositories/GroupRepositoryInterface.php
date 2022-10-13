<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Queries\Group\ViewGroupQuery;
use Illuminate\Database\Eloquent\Collection;

interface GroupRepositoryInterface
{
    public function findGroups(ViewGroupQuery $query): Collection;
}