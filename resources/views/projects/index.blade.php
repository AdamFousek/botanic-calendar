<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 md:mb-0">
                {{ __('My Projects') }}
            </h2>
            <div class="">
                <form action="{{ route('projects.index') }}" method="GET" class="flex flex-wrap">
                    <x-text-input name="search" value="{{ $searchQuery }}" type="text" placeholder="{{ __('Search') }}" class="py-1 px-2 mr-2"></x-text-input>
                    <x-primary-button type="submit" class="p-1">{{ __('Search') }}</x-primary-button>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('projects.create') }}" type="button-outline-sm">
                {{ __('Create project') }}
            </x-primary-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (!$projects->isEmpty())
        <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($projects as $project)
                <x-projects.card :project="$project"></x-projects.card>
            @endforeach
         </div>
        @else
            <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">There is no projects found. You can search for public projects</div>
        @endif
    </div>
</x-app-layout>
