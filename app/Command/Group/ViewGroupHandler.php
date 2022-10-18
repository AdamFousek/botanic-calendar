<?php
declare(strict_types=1);


namespace App\Command\Group;

use App\Queries\Group\ViewGroupQuery;
use App\Repositories\GroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ViewGroupHandler
{
    public function __construct(
        private readonly GroupRepositoryInterface $groupRepository,
    ) {

    }

    public function handle(ViewGroup $command): Collection
    {
        $query = $this->transform($command);

        return $this->groupRepository->findGroups($query);
    }

    private function transform(ViewGroup $command): ViewGroupQuery
    {
        return new ViewGroupQuery(
            $command->getUserId(),
            $command->getQuery(),
            $command->isPublic(),
        );
    }
}
