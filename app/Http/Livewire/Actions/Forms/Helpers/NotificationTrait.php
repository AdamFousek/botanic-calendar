<?php

declare(strict_types=1);

namespace App\Http\Livewire\Actions\Forms\Helpers;

trait NotificationTrait
{
    public array $notifications = [];

    public function addNotification(): void
    {
        $data = [
            'days' => 1,
        ];

        $this->notifications[] = $data;
    }

    public function removeNotification(int $index): void
    {
        unset($this->notifications[$index]);
    }
}
