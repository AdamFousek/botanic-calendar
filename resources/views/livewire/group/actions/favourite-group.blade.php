@if (!$isFavourite)
    <x-icon-wrapper wire:click="toggleFavourite" name="star" variant="outline" class="cursor-pointer" title="{{ __('Mark as favourite') }}"/>
@else
    <x-icon-wrapper wire:click="toggleFavourite" name="star" variant="solid" class="cursor-pointer text-yellow-500" title="{{ __('Remove from favourite') }}" />
@endif
