<div class="overflow-hidden min-h-0">
    <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <h3 class="text-xl">{{ __('Experiment settings') }}</h3>
        <form wire:submit.prevent="update">

            <div class="mt-4">
                <div class="flex flex-wrap items-center">
                    <h4 class="text-lg mr-1">{{ __('Actions') }}</h4>
                    <x-primary-link wire:click="addAction" class="text-sm cursor-pointer" type="link">{{ __('Add action') }}</x-primary-link>
                </div>

                @foreach($actions as $index => $action)
                    <div class="my-1">
                        <x-input-label for="action.{{ $index }}" :value="__('Action name')" />
                        <div class="flex flex-wrap items-center">
                            <x-text-input wire:model.lazy="actions.{{ $index }}.name" id="action.{{ $index }}" class="inline-block mr-2" type="text" name="action.{{ $index }}" />
                            <x-primary-link wire:click="removeAction({{ $index }})" class="cursor-pointer" type="link-red">{{ __('Remove action') }}</x-primary-link>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <div class="flex flex-wrap items-center">
                    <h4 class="text-lg mr-1">{{ __('Add another fields') }}</h4>
                    <x-primary-link wire:click="addField" class="text-sm cursor-pointer" type="link">{{ __('Add field') }}</x-primary-link>
                </div>

                @foreach($fields as $index => $field)
                    <div class="my-1">
                        <x-input-label for="field.{{ $index }}" :value="__('Field name')" />
                        <div class="flex flex-wrap items-center">
                            <x-text-input wire:model.lazy="fields.{{ $index }}.name" id="field.{{ $index }}" class="inline-block mr-2" type="text" name="fields.{{ $index }}.name" />
                            <x-primary-link wire:click="removeField({{ $index }})" class="cursor-pointer" type="link-red">{{ __('Remove field') }}</x-primary-link>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-end justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
