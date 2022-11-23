@props(['project'])

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
                <form wire:submit.prevent="create">
                    @csrf
                    <x-text-input wire:model="projectId" id="name" class="block mt-1 w-full" type="hidden" name="projectId" :value="$projectId" autofocus />

                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Project name')" />

                        <x-text-input wire:model.lazy="name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />

                        @error('name')
                        <x-input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Create Experiment') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
