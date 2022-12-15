<?php

declare(strict_types=1);

namespace App\Http\Livewire\Actions\Forms\Helpers;

trait FieldsTrait
{
    public array $fields = [];

    public function addField(): void
    {
        $data = [
            'name' => '',
            'type' => 'number',
            'options' => [],
            'operations' => [],
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

    public function addOperation(int $index): void
    {
        $data = [
            'operation' => 'subtract',
            'fromField' => '',
            'field' => '',
        ];

        $this->fields[$index]['operations'][] = $data;
    }

    public function removeOperation(int $fieldIndex, int $index): void
    {
        unset($this->fields[$fieldIndex]['operations'][$index]);
    }
}
