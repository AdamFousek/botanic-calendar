<?php
declare(strict_types=1);


namespace App\Command\Project;

use App\Queries\Project\ViewProjectQuery;
use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Collection;

class ViewProjectHandler
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
    ) {

    }

    public function handle(ViewProject $command): Collection
    {
        $query = new ViewProjectQuery(
            $command->getUserId(),
            $command->getSearchQuery(),
            $command->isPublic()
        );

        return $this->projectRepository->getProjects($query);
    }
}