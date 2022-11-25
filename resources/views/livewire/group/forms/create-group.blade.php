<form wire:submit.prevent="create">
    @csrf

    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="groupName" :value="__('Group name')" />

        <x-text-input wire:model.lazy="groupName" id="groupName" class="block mt-1 w-full" type="text" name="groupName" required autofocus />

        @error('groupName')
            <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="block mt-4">
        <label for="isPublic" class="inline-flex items-center">
            <input wire:model.lazy="isPublic" id="isPublic" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" name="is_public">
            <span class="ml-2 text-sm text-gray-600">{{ __('Is group public?') }}</span>
        </label>
    </div>

    <div class="mt-4">
        <x-input-label for="groupDescription" :value="__('Group description')" />

        <textarea wire:model.lazy="groupDescription" name="groupDescription" id="groupDescription" class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"></textarea>

        @error('groupDescription')
            <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Create Group') }}
        </x-primary-button>
    </div>
</form>