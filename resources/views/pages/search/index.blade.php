<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 md:mb-0">
                {{ __('Search') }}
            </h2>
            <div class="">
                <form action="{{ route('projects.index') }}" method="GET" class="flex flex-wrap">
                    <x-text-input name="search" value="{{ $searchQuery }}" type="text" placeholder="{{ __('Search') }}" class="py-1 px-2 mr-2"></x-text-input>
                    <x-primary-button type="submit" class="p-1">{{ __('Search') }}</x-primary-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-search.tabs :projects="$projects" :groups="$groups"></x-search.tabs>
            </div>
        </div>
    </div>
</x-app-layout>
