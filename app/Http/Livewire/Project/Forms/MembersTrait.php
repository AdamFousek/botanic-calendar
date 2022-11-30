<?php

declare(strict_types=1);

namespace App\Http\Livewire\Project\Forms;

trait MembersTrait
{
    public function toggleMembers($userId): void
    {
        if (isset($this->members[$userId])) {
            unset($this->members[$userId]);
        } else {
            $this->members[$userId] = $this->filteredUsers[$userId];
        }

        $this->username = '';
        $this->filteredUsers = [];
    }
}
