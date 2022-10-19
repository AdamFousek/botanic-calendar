<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Command\Project\InsertProjectCommand;
use App\Models\Project;
use App\Queries\Project\ViewProjectQuery;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryInterface
{
    public function insert(InsertProjectCommand $command): Project;

    public function getProjects(ViewProjectQuery $query): Collection;
}