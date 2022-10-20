<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class GroupTransformer
{
    public function __construct(
        private readonly UserTransformer $userTransformer,
    ) {
    }

    /**
     * @param Group $group
     * @return array<string, mixed>
     */
    public function transform(Group $group)
    {
        return [
            'name' => $group->name,
            'description' => $group->description,
            'uuid' => $group->uuid,
            'isPublic' => $group->is_public,
            'author' => $this->userTransformer->transform($group->user),
            'members' => $this->userTransformer->transformMulti($group->users),
        ];
    }

    /**
     * @param Collection<Group> $collection
     * @return array<array<string, mixed>
     */
    public function transformMulti(Collection $collection): array
    {
        $groups = [];
        foreach ($collection as $group) {
            $groups[] = $this->transform($group);
        }

        return $groups;
    }
}
