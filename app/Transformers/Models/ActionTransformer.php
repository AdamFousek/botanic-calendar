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
        return [
            'id' => $action->id,
            'parent_id' => $action->action?->id,
            'parent_name' => $action->action?->name,
            'name' => $action->name,
            'experiment_id' => $action->experiment_id,
            'fields' => $this->resolveFields($action->fields),
            'notifications' => $this->resolveNotifications($action->notifications),
            'subActions' => $this->resolveSubActions($action->subActions),
        ];
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
     * @param array $fields
     * @return array<string, mixed>
     */
    private function resolveFields(array $fields): array
    {
        $result = [];
        foreach ($fields as $field) {
            $result[] = $field;
        }

        return $result;
    }

    /**
     * @param array $notifications
     * @return array
     */
    private function resolveNotifications(array $notifications)
    {
        $result = [];

        foreach ($notifications as $notification) {
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
