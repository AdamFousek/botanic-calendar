@if (!$isFavourite)
    <x-primary-button wire:click="toggleFavourite" color="primary-outline" class="mb-0">
        {{ __('Mark as favourite') }}
    </x-primary-button>
@else
    <x-primary-button wire:click="toggleFavourite" color="red-outline" class="mb-0">
        {{ __('Remove from favourite') }}
    </x-primary-button>
@endif
