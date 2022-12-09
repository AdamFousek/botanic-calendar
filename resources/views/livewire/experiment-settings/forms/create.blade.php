<div class="overflow-hidden min-h-0">
    <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <h3 class="text-xl">{{ __('Experiment settings') }}</h3>
        <form wire:submit.prevent="save">

            <div class="mt-4">
                <div class="flex flex-wrap items-center">
                    <h4 class="text-lg mr-1">{{ __('Actions') }}</h4>
                    <x-primary-link wire:click="addAction" class="text-sm cursor-pointer" type="link">{{ __('Add action') }}</x-primary-link>
                </div>

                @foreach($actions as $index => $action)
                    <div class="my-1">

                        <div class="flex flex-wrap items-center">
                            <div>
                                <x-input-label for="action.{{ $index }}.name" :value="__('Action name')" />
                                <x-text-input wire:model.lazy="actions.{{ $index }}.name" id="action.{{ $index }}.name" class="inline-block mr-2 p-2" type="text" name="action.{{ $index }}" />
                            </div>
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
                        <div class="flex flex-wrap items-center">
                            <div>
                                <x-input-label for="field.{{ $index }}.name" :value="__('Field name')" />
                                <x-text-input wire:model.lazy="fields.{{ $index }}.name" id="field.{{ $index }}.name" class="inline-block mr-2 p-2" type="text" name="fields.{{ $index }}.name" />
                            </div>
                            <div>
                                <x-input-label for="field.{{ $index }}.type" :value="__('Type of Field')" />
                                <select wire:model.lazy="fields.{{ $index }}.type" id="field.{{ $index }}.type"
                                        class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                    <option value="number" selected>{{ __('Number') }}</option>
                                    <option value="datetime">{{ __('Datetime') }}</option>
                                    <option value="text">{{ __('Text') }}</option>
                                    <option value="select">{{ __('Select') }}</option>
                                </select>
                            </div>

                            <x-primary-link wire:click="removeField({{ $index }})" class="cursor-pointer" type="link-red">{{ __('Remove field') }}</x-primary-link>
                        </div>
                        @if($field['type'] === 'select')
                            <x-primary-link wire:click="addSubField({{ $index }})" class="text-sm cursor-pointer" type="link">{{ __('Add select option') }}</x-primary-link>
                            @foreach($field['fields'] as $i => $option)
                                <div class="flex flex-wrap items-center">
                                    <x-text-input wire:model.lazy="fields.{{ $index }}.fields.{{ $i }}.option" id="field.{{ $index }}.fields.{{ $i }}.option" class="inline-block mr-2 p-2" type="text" name="fields.{{ $index }}.fields.{{ $i }}.option" />
                                    <x-primary-link wire:click="removeSubfield({{ $index }}, {{ $i }})" class="cursor-pointer" type="link-red">{{ __('Remove field') }}</x-primary-link>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <div class="flex flex-wrap items-center">
                    <h4 class="text-lg mr-1">{{ __('Add notifications') }}</h4>
                    <x-primary-link wire:click="addNotification" class="text-sm cursor-pointer" type="link">{{ __('Add notification') }}</x-primary-link>
                </div>

                @foreach($notifications as $index => $notify)
                    <div class="my-1 flex flex-wrap items-center">
                        <div>
                            <x-input-label for="notifications.{{ $index }}.action" :value="__('Action')" />
                            <select wire:model.lazy="notifications.{{ $index }}.action" id="notifications.{{ $index }}.action"
                                    class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                <option >{{ __('Select action') }}</option>
                                @foreach($actions as $action)
                                    <option value="{{ $action['name'] }}">{{ $action['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="notifications.{{ $index }}.days" :value="__('NUmber of days')" />
                            <x-text-input wire:model.lazy="notifications.{{ $index }}.days" id="notifications.{{ $index }}.days" class="inline-block mr-2 p-2" type="number" name="notifications.{{ $index }}.days" min="1" />
                        </div>

                        <x-primary-link wire:click="removeNotification({{ $index }})" class="cursor-pointer" type="link-red">{{ __('Remove field') }}</x-primary-link>
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
