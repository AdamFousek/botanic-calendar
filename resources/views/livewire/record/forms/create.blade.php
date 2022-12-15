<form wire:submit.prevent="create">
    @csrf

    @if($errors->any())
        @foreach($errors->all() as $message)
            <x-input-error :messages="$message" class="mt-2" />
        @endforeach
    @endif

    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="date" :value="__('Date')" />

        <x-text-input wire:model.lazy="date" id="date" class="block mt-1 w-full" type="date" name="date" />
    </div>


    <div class="mt-4">
        <x-input-label for="record.action" :value="__('Action')" />

        <select wire:model.lazy="record.action" id="record.action"
                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
            @foreach($experiment->actions as $action)
                <option value="{{ $action->id }}">{{ $action->name  }}</option>
            @endforeach
        </select>
    </div>

    @foreach($transformedAction['fields'] as $field)
        @if($field['type'] === 'calculated') @continue @endif
        <div class="mt-4">
            <x-input-label for="values.{{ $field['name'] }}" :value="$field['name']" />

            @if($field['type'] === 'select')
            <select wire:model.lazy="values.{{ $field['name'] }}.value" id="values.{{ $field['name'] }}"
                    class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                    <option value="">{{ __('Select option') }}</option>
                @foreach($field['options'] as $option)
                    <option value="{{ $option['option'] }}">{{ $option['option'] }}</option>
                @endforeach
            </select>
            @else
                <x-text-input wire:model.lazy="values.{{ $field['name'] }}.value" id="values.{{ $field['name'] }}" class="block mt-1 w-full" type="{{ $field['type'] }}" name="values.{{ $field['name'] }}" />
            @endif

            @error('record.action')
            <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>
    @endforeach

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Add record') }}
        </x-primary-button>
    </div>
</form>