<div class="overflow-hidden min-h-0">
    <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <h3 class="text-xl">{{ __('Experiment action') }}</h3>
        <form wire:submit.prevent="update">

            @if($errors->any())
                @foreach($errors->all() as $message)
                    <x-input-error :messages="$message" class="mt-2" />
                @endforeach
            @endif

            <div class="mt-4">
                <x-input-label for="actionName" :value="__('Action name')" />

                <x-text-input wire:model.lazy="action.name" id="actionName" class="block mt-1 w-full" type="text" name="actionName" :value="old('actionName')" autofocus />
            </div>

            <div class="mt-4">
                <x-input-label for="actionParent" :value="__('Action parent')" />

                <select wire:model.lazy="action.parent_id" id="action.parent_id"
                        class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                    <option value="{{ null }}">{{ __('Remove parent') }}</option>
                    @foreach($experiment->actions as $experimentAction)
                        @if($experimentAction->id !== $action->id)
                            <option value="{{ $experimentAction->id }}">{{ $experimentAction->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <div class="flex flex-wrap items-center">
                    <h4 class="text-lg mr-1">{{ __('Fields') }}</h4>
                    <x-icon-link wire:click="addField" title="{{ __('Add field') }}" name="plus" variant="mini" class="cursor-pointer hover:bg-emerald-500" />
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
                                    @foreach(\App\Models\Experiment\Action::AVAILABLE_TYPES as $key => $type)
                                        <option value="{{ $key }}">{{ __($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-icon-link wire:click="removeField({{ $index }})" title="{{ __('Remove field') }}" name="trash" variant="mini" class="self-end cursor-pointer hover:bg-red-500" />
                        </div>
                        <div class="my-2">
                            @if($field['type'] === 'select')
                                <x-primary-link wire:click="addSubField({{ $index }})" class="text-sm cursor-pointer" type="link">{{ __('Add select option') }}</x-primary-link>
                                @foreach($field['options'] as $i => $option)
                                    <div class="flex flex-wrap items-center">
                                        <x-text-input wire:model.lazy="fields.{{ $index }}.options.{{ $i }}.option" id="field.{{ $index }}.options.{{ $i }}.option" class="inline-block mr-2 p-2" type="text" name="fields.{{ $index }}.options.{{ $i }}.option" />
                                        <x-icon-link wire:click="removeSubfield({{ $index }}, {{ $i }})" title="{{ __('Remove field') }}" name="trash" variant="mini" class="self-end cursor-pointer hover:bg-red-500" />
                                    </div>
                                @endforeach
                            @endif
                            @if($field['type'] === 'calculated')
                                <div class="my-1 flex flex-wrap items-center">
                                    <div>
                                        <x-input-label for="fields.{{ $index }}.calculated.fromAction" :value="__('Action')" />
                                        <select wire:model.lazy="fields.{{ $index }}.calculated.fromAction" id="fields.{{ $index }}.calculated.fromAction"
                                                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                            <option value="0">{{ __('Current') }}</option>
                                            @foreach($experiment->actions as $action)
                                                <option value="{{ $action->id }}">{{ $action->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="fields.{{ $index }}.calculated.fromField" :value="__('Field from')" />
                                        <select wire:model.lazy="fields.{{ $index }}.calculated.fromField" id="fields.{{ $index }}.calculated.fromField"
                                                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                            <option value>{{ __('Select field') }}</option>
                                            @foreach($availableFieldsFrom[$index] as $afield)
                                                <option value="{{ $afield }}">{{ $afield }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="fields.{{ $index }}.calculated.operation" :value="__('Operation')" />
                                        <select wire:model.lazy="fields.{{ $index }}.calculated.operation" id="fields.{{ $index }}.calculated.operation"
                                                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                            <option value>{{ __('Select operation') }}</option>
                                            @foreach($selectOperations as $value => $operation)
                                                <option value="{{ $value }}">{{ $operation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="fields.{{ $index }}.calculated.action" :value="__('Action')" />
                                        <select wire:model.lazy="fields.{{ $index }}.calculated.action" id="fields.{{ $index }}.calculated.action"
                                                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                            <option value="0">{{ __('Current') }}</option>
                                            @foreach($experiment->actions as $action)
                                                <option value="{{ $action->id }}">{{ $action->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="fields.{{ $index }}.calculated.field" :value="__('Field from')" />
                                        <select wire:model.lazy="fields.{{ $index }}.calculated.field" id="fields.{{ $index }}.calculated.field"
                                                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                                            <option >{{ __('Select field') }}</option>
                                            @foreach($availableFields[$index] as $afield)
                                                <option value="{{ $afield }}">{{ $afield }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <div class="flex flex-wrap items-center">
                    <h4 class="text-lg mr-1">{{ __('Add notifications') }}</h4>
                    <x-icon-link wire:click="addNotification" title="{{ __('Add notification') }}" name="plus" variant="mini" class="cursor-pointer hover:bg-emerald-500" />
                </div>

                @foreach($notifications as $index => $notify)
                    <div class="my-1 flex flex-wrap items-center">
                        <div>
                            <x-input-label for="notifications.{{ $index }}.days" :value="__('Number of days')" />
                            <x-text-input wire:model.lazy="notifications.{{ $index }}.days" id="notifications.{{ $index }}.days" class="inline-block mr-2 p-2" type="number" name="notifications.{{ $index }}.days" min="1" />
                        </div>
                        <x-icon-link wire:click="removeNotification({{ $index }})" title="{{ __('Remove notification') }}" name="trash" variant="mini" class="self-end cursor-pointer hover:bg-red-500" />
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
