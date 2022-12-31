<?php

declare(strict_types=1);

namespace App\Http\Livewire\Actions\Forms\Helpers;

use App\Models\Experiment\Action;
use App\Transformers\Models\ActionTransformer;

trait FieldsTrait
{
    public array $fields = [];

    public function addField(): void
    {
        $data = [
            'name' => '',
            'type' => 'number',
            'options' => [],
            'calculating' => [
                'operation' => 'subtract',
                'fromAction' => 0,
                'fromField' => '',
                'action' => 0,
                'field' => '',
            ],
        ];

        $this->fields[] = $data;
    }

    public function removeField(int $index): void
    {
        unset($this->fields[$index]);
    }

    public function addSubField(int $index): void
    {
        $this->fields[$index]['options'][] = [
            'option' => '',
        ];
    }

    public function removeSubfield(int $fieldIndex, int $subfieldIndex): void
    {
        unset($this->fields[$fieldIndex]['options'][$subfieldIndex]);
    }

    private function resolveAvailableFields(ActionTransformer $actionTransformer, string $field): array
    {
        $availableFields = [];
        foreach ($this->fields as $key => $f) {
            if ($f['type'] === Action::TYPE_CALCULATED) {
                $availableFields[$key] = [];
                $actionId = (int) $f['calculating'][$field];
                if ($actionId === 0) {
                    foreach ($this->fields as $thisField) {
                        if ($thisField['type'] === 'number') {
                            $availableFields[$key][$thisField['name']] = $thisField['name'];
                        }
                    }
                } else {
                    $action = $this->experiment->actions->filter(function (Action $action) use ($actionId) {
                        return $action->id === $actionId;
                    })->first();
                    $transformedAction = $actionTransformer->transform($action);
                    foreach ($transformedAction['fields'] as $tAction) {
                        if ($tAction['type'] === 'number') {
                            $availableFields[$key][$tAction['name']] = $tAction['name'];
                        }
                    }
                }
            }
        }

        return $availableFields;
    }

    private function resolveFields(array $fields)
    {
        foreach ($fields as $field) {
            if ($field['type'] !== Action::TYPE_CALCULATED) {
                $field['calculating'] = [];
            }
        }

        return $fields;
    }
}
