<form wire:submit.prevent="update">
    @csrf
    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="experimentName" :value="__('Experiment name')" />

        <x-text-input wire:model.lazy="experiment.name" id="experimentName" class="block mt-1 w-full" type="text" name="experimentName" :value="old('experimentName')" autofocus />

        @error('experiment.name')
        <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="flex items-end justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>