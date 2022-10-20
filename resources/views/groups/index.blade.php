<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 md:mb-0">
                {{ __('All public Projects') }}
            </h2>
            <div class="">
                <form action="{{ route('groups.index') }}" method="GET" class="flex flex-wrap">
                    <x-text-input name="search" value="{{ $searchQuery }}" type="text" placeholder="{{ __('Search') }}" class="py-1 px-2 mr-2"></x-text-input>
                    <x-primary-button type="submit" class="p-1">{{ __('Search') }}</x-primary-button>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('groups.create') }}" type="button-outline-sm">
                {{ __('Create group') }}
            </x-primary-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($groups !== [])
            <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($groups as $group)
                    <x-groups.card :group="$group"></x-groups.card>
                @endforeach
            </div>
        @else
            <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">There is no projects found. You can search for public projects</div>
        @endif
    </div>
</x-app-layout>
