<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('All public Projects') }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('groups.create') }}" type="button-outline-sm">
                {{ __('Create group') }}
            </x-primary-link>
        </div>
    </x-slot>

    <livewire:group.pages.my-groups />
</x-app-layout>
