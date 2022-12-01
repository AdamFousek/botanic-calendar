<form wire:submit.prevent="update">
    @csrf
    <div class="mt-4">
        <x-input-label for="firstName" :value="__('First Name')" />

        <x-text-input wire:model.lazy="user.first_name" id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" autofocus />

        @error('firstName')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>
    <div class="mt-4">
        <x-input-label for="lastName" :value="__('Last Name')" />

        <x-text-input wire:model.lazy="user.last_name" id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('firstName')" autofocus />

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

        @if ($photo)
            <div class="my-2">
                Photo Preview:
                <img src="{{ $photo->temporaryUrl() }}">
            </div>
        @endif
        <label class="flex my-4">
            <input class="mx-2" type="checkbox" name="removePhoto" id="removePhoto" wire:model.lazy="removePhoto" />
            {{ __('Remove current photo') }}
        </label>
    </div>
    <div class="flex items-center justify-between mt-4">
        <x-primary-link :href="route('user.show', $user)" type="button-outline-sm">
            {{ __('Back') }}
        </x-primary-link>
        <x-primary-button class="ml-4">
            {{ __('Edit') }}
        </x-primary-button>
    </div>
</form>