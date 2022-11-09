<form wire:submit.prevent="update">
    @csrf
    <div class="mt-4">
        <x-input-label for="firstName" :value="__('First Name')" />

        <x-text-input wire:model.lazy="firstName" id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" autofocus />

        @error('firstName')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>
    <div class="mt-4">
        <x-input-label for="lastName" :value="__('Last Name')" />

        <x-text-input wire:model.lazy="lastName" id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('firstName')" autofocus />

        @error('firstName')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="mt-4">
        <x-input-label for="photo" :value="__('Photo')" />

        <input type="file" wire:model="photo">
        @error('photo')
            <x-input-error :messages="$message" class="mt-2" />
        @enderror
        <label class="flex my-4">
            <input class="mx-2" type="checkbox" name="removePhoto" id="removePhoto" wire:model.lazy="removePhoto" /> {{ __('Remove actual photo') }}
        </label>
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Edit') }}
        </x-primary-button>
    </div>
</form>