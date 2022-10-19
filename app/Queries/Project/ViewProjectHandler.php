<?php
declare(strict_types=1);


namespace App\Queries\Project;

use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ViewProjectHandler
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
    ) {

    }

    public function handle(ViewProjectQuery $query): Collection
    {
        return $this->projectRepository->getProjects($query);
    }
}