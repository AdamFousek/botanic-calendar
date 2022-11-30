<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <x-text-input wire:model.debounc.500ms="searchText" id="searchText" name="searchText" placeholder="{{ __('Search group') }}" type="text" class="py-1 px-2 mr-2"></x-text-input>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div wire:loading.delay.shortest>{{ __('Loading...') }}</div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div wire:loading.class="opacity-50 pointer-events-none">
            @if ($favouriteGroups !== [])
                <div class="w-full border-b py-4 mb-4">
                    <h2 class="text-2xl mb-2">{{ __('Favourite projects') }}</h2>
                    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($favouriteGroups as $group)
                            <x-groups.card :group="$group" :wire:key="$group->id"></x-groups.card>
                        @endforeach
                    </div>
                </div>
            @endif
            @if ($groups !== [])
                <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($groups as $group)
                        <x-groups.card :group="$group" :wire:key="$group->id"></x-groups.card>
                    @endforeach
                </div>
            @else
                <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">
                    {{ __('No groups found.') }}
                </div>
            @endif
        </div>
    </div>
</div>
