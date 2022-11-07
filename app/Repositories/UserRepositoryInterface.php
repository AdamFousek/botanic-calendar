<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Queries\User\ViewGroupsQuery;
use App\Queries\User\ViewUserByIdQuery;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): ?User;

    public function getGroups(ViewGroupsQuery $query): Collection;

    public function getById(ViewUserByIdQuery $query): ?User;
}
