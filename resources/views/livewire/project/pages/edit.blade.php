<main class="py-2 md:py-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <livewire:project.forms.edit-project :project="$project"/>
                <div>
                    <h4 class="text-lg">{{ __('Delete project') }}</h4>
                    <div>
                        <x-primary-button class="cursor-pointer" type="''" color="red" data-bs-toggle="modal" data-bs-target="#deleteProject">
                            {{ __('Delete project') }}
                        </x-primary-button>
                    </div>
                    <livewire:project.forms.delete-project :project="$project"/>
                </div>
            </div>
        </div>
    </div>
</main>
