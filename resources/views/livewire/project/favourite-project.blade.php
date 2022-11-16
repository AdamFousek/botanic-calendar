<x-primary-link wire:click="toggleFavourite" type="button-sm">
    @if ($isFavourite)
        {{ __('Mark as favourite') }}
    @else
        {{ __('Remove from favourite') }}
    @endif
</x-primary-link>
