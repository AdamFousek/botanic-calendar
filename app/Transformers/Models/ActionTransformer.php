<?php

declare(strict_types=1);

namespace App\Transformers\Models;

use App\Models\Experiment\Action;
use Illuminate\Database\Eloquent\Collection;

class ActionTransformer
{
    /**
     * @param Action $action
     * @return array<string, mixed>
     * @throws \JsonException
     */
    public function transform(Action $action): array
    {
        $data = [
            'id' => $action->id,
            'parent_id' => $action->action?->id,
            'parent_name' => $action->action?->name,
            'name' => $action->name,
            'experiment_id' => $action->experiment_id,
            'fields' => $this->resolveFields($action->fields),
            'notifications' => $this->resolveNotifications($action->notifications),
            'subActions' => $this->resolveSubActions($action->subActions),
        ];

        return $data;
    }

    /**
     * @param Collection<Action> $actions
     * @return array
     */
    public function transformMulti(Collection $actions): array
    {
        $result = [];
        foreach ($actions as $action) {
            $result[] = $this->transform($action);
        }

        return $result;
    }

    /**
     * @param string|null $fields
     * @return array<string, mixed>
     * @throws \JsonException
     */
    private function resolveFields(?string $fields): array
    {
        $result = [];
        if ($fields === null) {
            return $result;
        }

        $decodedFields = (array) json_decode($fields, true, 512, JSON_THROW_ON_ERROR);
        foreach ($decodedFields as $field) {
            $result[] = $field;
        }

        return $result;
    }

    /**
     * @param string|null $notifications
     * @return array
     * @throws \JsonException
     */
    private function resolveNotifications(?string $notifications)
    {
        $result = [];
        if ($notifications === null) {
            return $result;
        }

        $decodedNotifications = (array) json_decode($notifications, true, 512, JSON_THROW_ON_ERROR);
        foreach ($decodedNotifications as $notification) {
            $result[] = $notification;
        }

        return $result;
    }

    private function resolveSubActions(Collection $subActions): array
    {
        $result = [];
        foreach ($subActions as $action) {
            $result[] = $this->transform($action);
        }

        return $result;
    }
}
