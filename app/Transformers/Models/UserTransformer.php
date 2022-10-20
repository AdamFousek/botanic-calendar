<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserTransformer
{
    /**
     * @param User $user
     * @return array<string, mixed>
     */
    public function transform(User $user): array
    {
        return [
            'username' => $user->username,
            'fullName' => ucfirst($user->first_name).' '.ucfirst($user->last_name),
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'createdAt' => $user->created_at->format('j.n.Y'),
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
