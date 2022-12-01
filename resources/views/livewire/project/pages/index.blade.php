<main class="py-2 md:py-6">
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

    <livewire:project.components.my-projects />
</main>
