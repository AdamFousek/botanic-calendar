@props(['project'])

<form wire:submit.prevent="create">
    @csrf
    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="experimentName" :value="__('Experiment name')" />

        <x-text-input wire:model.lazy="experiment.name" id="experimentName" class="block mt-1 w-full" type="text" name="experimentName" :value="old('experimentName')" autofocus />

        @error('experiment.name')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="mt-4">
        <x-input-label for="experiment.color" :value="__('Experiment color')" class="inline-block"/>

        <x-text-input wire:model.lazy="experiment.color" id="experiment.color" class="inline-block mt-1" type="color" name="experiment.color" />

        @error('experiment.color')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Create Experiment') }}
        </x-primary-button>
    </div>
</form>
