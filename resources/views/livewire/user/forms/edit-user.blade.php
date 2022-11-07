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
        @if ($photo)
            <div class="my-4 flex justify-center border" style="width: 150px; height: 150px;">
                <img class="align-middle border-none" src="{{ $photo->temporaryUrl() }}">
            </div>
        @endif
        @error('photo')
            <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Edit') }}
        </x-primary-button>
    </div>
</form>