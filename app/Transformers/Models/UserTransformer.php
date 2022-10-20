<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserTransformer
{
    public function __construct(
        private readonly GroupTransformer $groupTransformer,
        private readonly ProjectTransformer $projectTransformer,
    ) {
    }

    /**
     * @param User $user
     * @return array<string, mixed>
     */
    public function transform(User $user): array
    {
        return [
            'username' => $user->username,
            'fullName' => $user->fullName(),
            'email' => $user->email,
            'createdAt' => $user->created_at->format('j.n.Y'),
            'projects' => $this->projectTransformer->transformMulti($user->projects),
            'myGroups' => $this->groupTransformer->transformMulti($user->groups),
            'memberGroups' => $this->groupTransformer->transformMulti($user->memberGroups),
        ];
    }

    /**
     * @param Collection<User> $collection
     * @return array
     */
    public function transformMulti(Collection $collection): array
    {
        $users = [];
        foreach ($collection as $user) {
            $users[] = $this->transform($user);
        }

        return $users;
    }
}
