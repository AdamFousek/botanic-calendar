<main class="py-2 md:py-6">
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ $group->name }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <livewire:group.actions.favourite-group :uuid="$group->uuid"/>
            @can('update', $group)
                <x-primary-link href="{{ route('groups.edit', $group->uuid) }}" type="button-outline-sm">
                    {{ __('Edit group') }}
                </x-primary-link>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full grid grid-cols-1 items-start md:grid-cols-4 gap-4 mb-4">
            <div class="md:col-span-3 overflow-hidden min-h-0">
                <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    {{ $group->description }}
                </div>
                <div class="w-full">
                    <x-groups.projects :projects="$projects" :group="$group"></x-groups.projects>
                </div>
            </div>
            <div class="bg-white md:col-span-1 overflow-hidden min-h-0 shadow-sm sm:rounded-lg">
                <x-groups.informations :group="$group" class="p-6 bg-white border-b border-gray-200"></x-groups.informations>
            </div>
        </div>
    </div>
    @can('inviteMember', $group)
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="inviteMember" tabindex="-1" aria-labelledby="InviteMember" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="teext-xl font-medium leading-normal text-gray-800" id="exampleModalLongLabel">
                            Invite member
                        </h5>
                        <button type="button"
                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:group.forms.invite-member :group="$group"></livewire:group.forms.invite-member>
                </div>
            </div>
        </div>
    @endif
    @can('create', [\App\Models\Project::class, $group])
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createProject" tabindex="-1" aria-labelledby="CreateProject" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLongLabel">
                            {{ __('Create project') }}
                        </h5>
                        <button type="button"
                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer p-4 border-t border-gray-200 rounded-b-md">
                        <livewire:project.forms.create-project :group="$group"/>
                    </div>
                </div>
            </div>
        </div>
    @endif
</main>
