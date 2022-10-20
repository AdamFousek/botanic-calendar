<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class GroupTransformer
{
    /**
     * @param Group $group
     * @return array<string, mixed>
     */
    public function transform(Group $group): array
    {
        $userTransformer = new UserTransformer();

        return [
            'uuid' => $group->uuid,
            'name' => $group->name,
            'description' => $group->description,
            'isPublic' => $group->is_public,
            'createdAt' => $group->created_at->format('j.d.Y'),
            'author' => $userTransformer->transform($group->user),
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
