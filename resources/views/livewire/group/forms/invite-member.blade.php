<form wire:submit.prevent="invite">
    @csrf
    <div class="modal-body relative p-4">
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input wire:model.debounce.500ms="email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />

            @error('email')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
        </div>
    </div>
    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
        <x-primary-button data-bs-dismiss="modal" color="red-outline" type="''">
            {{ __('Close') }}
        </x-primary-button>
        <x-primary-button>
            {{ __('Send invitation') }}
        </x-primary-button>
    </div>
</form>
