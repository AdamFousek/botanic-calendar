<main class="py-2 md:py-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            @can('update', $project)
            <x-primary-link href="{{ route('projects.edit', $project->uuid) }}" type="button-outline-sm">
                {{ __('Edit project') }}
            </x-primary-link>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full grid grid-cols-1 items-start md:grid-cols-4 gap-4 mb-4">
            <div class="col-start-1 md:col-start-1 md:col-end-4">
                <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    {{ $project->description }}
                </div>
                <div class="w-full">
                    <div class="flex flex-wrap justify-between border-b mb-2 px-4 py-2 md:p-0">
                        <h2 id="projects" class="font-semibold text-xl text-gray-800 leading-tight md:mb-4">
                            {{ __('Experiments') }}
                        </h2>
                        @can('create', [\App\Models\Experiment::class, $project])
                        <x-primary-link type="link" class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#createExperiment">
                            {{ __('Create experiments') }}
                        </x-primary-link>
                        @endcan
                    </div>
                    <div>
                        @if (!$project->experiments->isEmpty())
                            <x-projects.experiments :project="$project" :experiments="$project->experiments"></x-projects.experiments>
                        @else
                            <div class="bg-white p-4 my-2">
                                {{ __('No experiments yet!') }}
                                @can('create', [\App\Models\Experiment::class, $project])
                                <x-primary-link type="link" class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#createExperiment">
                                    {{ __('Create one!') }}
                                </x-primary-link>
                                @endcan
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <x-projects.informations :project="$project"></x-projects.informations>
        </div>
        @can('create', [\App\Models\Experiment::class, $project])
        <!-- Modal -->
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createExperiment" tabindex="-1" aria-labelledby="CreateExperiment" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="CreteExperiment">
                            {{ __('Create Experiment') }}
                        </h5>
                        <button type="button"
                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer p-4 border-t border-gray-200 rounded-b-md">
                        <livewire:experiment.forms.create-experiment :project="$project" />
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
</main>
