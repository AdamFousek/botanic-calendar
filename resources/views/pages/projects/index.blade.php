<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('My Projects') }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('projects.create') }}" type="button-outline-sm">
                {{ __('Create project') }}
            </x-primary-link>
        </div>
    </x-slot>

    <livewire:project.pages.my-projects />
</x-app-layout>
