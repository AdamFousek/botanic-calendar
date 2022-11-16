<?php

declare(strict_types=1);

namespace App\Transformers\Helpers;

use App\Models\User;
use Illuminate\Support\Collection;

class MembersTransformer
{
    /**
     * @param Collection|array<User> $users
     * @return array<array<string, mixed>
     */
    public function transform(Collection|array $users): array
    {
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'username' => $user->username,
                'firstname' => $user->first_name,
                'lastName' => $user->last_name,
                'fullName' => trim($user->full_name),
                'isAdmin' => $user->pivot->is_admin,
            ];
        }

        return $result;
    }
}
