<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-text-input wire:model.debounc.500ms="searchText" id="searchText" name="searchText" placeholder="{{ __('Search project') }}" type="text" class="py-1 px-2 mr-2"></x-text-input>
    </div>
    <div wire:loading.delay.shortest class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        {{ __('Loading...') }}
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div wire:loading.class="opacity-50 pointer-events-none">
        @if ($favouriteProjects !== [])
            <div class="w-full border-b py-4 mb-4">
                <h2 class="text-2xl mb-2">{{ __('Favourite projects') }}</h2>
                <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($favouriteProjects as $project)
                        <x-projects.card :project="$project" :wire:key="$project['id']"></x-projects.card>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($projects !== [])
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($projects as $project)
                    <x-projects.card :project="$project" :wire:key="$project['id']"></x-projects.card>
                @endforeach
            </div>
        @else
            <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">{{ __('No projects found.') }}</div>
        @endif
        </div>
    </div>
</div>