<?php

declare(strict_types=1);

namespace App\Http\Livewire\Project\Forms;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait MembersTrait
{
    public array $filteredUsers = [];

    public Collection $members;

    public string $search = '';

    public function searchUser(): void
    {
        $this->filteredUsers = [];
        if ($this->search !== '') {
            $users = $this->group?->members;
            /** @var User $user */
            foreach ($users as $user) {
                $upperSearch = strtoupper(trim($this->search));
                $firstNameUpper = strtoupper($user->first_name ?? '');
                $lastNameUpper = strtoupper($user->last_name ?? '');
                $usernameUpper = strtoupper($user->username);

                if (
                    str_contains($firstNameUpper, $upperSearch) ||
                    str_contains($lastNameUpper, $upperSearch) ||
                    str_contains($usernameUpper, $upperSearch)
                ) {
                    $this->filteredUsers[$user->id] = $user;
                }
            }
        }
    }

    public function toggleMembers($userId): void
    {
        if ($this->members?->contains($userId)) {
            $this->members = $this->members->filter(function (User $user) use ($userId) {
                return $user->id !== $userId;
            });
        } else {
            $user = $this->group?->members->filter(function (User $user) use ($userId) {
                return $user->id === $userId;
            })->first();
            $this->members->push($user);
        }

        $this->search = '';
        $this->filteredUsers = [];
    }
}
