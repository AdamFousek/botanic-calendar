<form wire:submit.prevent="create">
    @csrf

    @if($errors->any())
        @foreach($errors->all() as $message)
            <x-input-error :messages="$message" class="mt-2" />
        @endforeach
    @endif

    @if($parent !== null)
        <div class="mt-4">
            <h4 class="text-lg">{{ __('Creating subrecord for record') }} {{ $parent->action->name }}</h4>
        </div>
        <input wire:mode.lazy="parentId" type="hidden" value="{{ $parent->id }}">
    @endif

    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="date" :value="__('Date')" />

        <x-text-input wire:model.lazy="date" id="date" class="block mt-1 w-full" type="date" name="date" />
    </div>


    <div class="mt-4">
        <x-input-label for="actionId" :value="__('Action')" />

        <select wire:model.lazy="actionId" id="actionId"
                class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
            @foreach($availableActions as $action)
                <option value="{{ $action->id }}">{{ $action->name  }}</option>
            @endforeach
        </select>
    </div>

    @foreach($transformedAction['fields'] as $field)
        @if($field['type'] === 'calculated') @continue @endif
        <div class="mt-4">
            <x-input-label for="values.{{ $field['name'] }}" :value="$field['name']" />

            @if($field['type'] === 'select')
            <select wire:model.lazy="values.{{ $field['name'] }}" id="values.{{ $field['name'] }}"
                    class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                    <option value="">{{ __('Select option') }}</option>
                @foreach($field['options'] as $option)
                    <option value="{{ $option['option'] }}">{{ $option['option'] }}</option>
                @endforeach
            </select>
            @else
                <x-text-input wire:model.lazy="values.{{ $field['name'] }}" id="values.{{ $field['name'] }}" class="block mt-1 w-full" type="{{ $field['type'] }}" name="values.{{ $field['name'] }}" />
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