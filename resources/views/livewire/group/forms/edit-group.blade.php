<form wire:submit.prevent="update">
    @csrf

    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="name" :value="__('Group name')" />

        <x-text-input wire:model.lazy="group.name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('groupName')" autofocus />

        @error('group.name')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="block mt-4">
        <label for="isPublic" class="inline-flex items-center">
            <input wire:model.lazy="isPublic" id="group.is_public" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" name="is_public">
            <span class="ml-2 text-sm text-gray-600">{{ __('Is group public?') }}</span>
        </label>
    </div>

    <div class="mt-4">
        <x-input-label for="description" :value="__('Group description')" />

        <textarea wire:model.lazy="group.description" name="description" id="description" class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">{{ old('groupDescription') }}</textarea>

        @error('groupDescription')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Edit Group') }}
        </x-primary-button>
    </div>
</form>