<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project['name'] }}
        </h2>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('projects.edit', $project['uuid']) }}" type="button-outline-sm">
                {{ __('Edit project') }}
            </x-primary-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full grid grid-cols-1 items-start md:grid-cols-4 gap-4 mb-4">
            <div class="col-start-1 md:col-start-1 md:col-end-4">
                <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    {{ $project['description'] }}
                </div>
                <div class="w-full">
                    <div class="flex flex-wrap justify-between border-b mb-4">
                        <h2 id="projects" class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                            {{ __('Experiments') }}
                        </h2>
                        <x-primary-link type="link" class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#createExperiment">
                            {{ __('Create experiments') }}
                        </x-primary-link>
                    </div>
                </div>
            </div>
            <x-projects.show.informations :project="$project" :group="$group"></x-projects.show.informations>
        </div>
    </div>
</x-app-layout>
