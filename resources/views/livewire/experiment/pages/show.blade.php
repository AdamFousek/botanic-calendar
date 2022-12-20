<main class="py-2 md:py-6">
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ $experiment->name }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('projects.show', $project) }}" type="button-outline-sm" class="mr-2">
                {{ __('Back to project') }}
            </x-primary-link>
            @can('update', $experiment)
            <x-primary-link href="{{ route('experiment.edit', [$project->uuid, $experiment->id]) }}" type="button-outline-sm">
                {{ __('Settings') }}
            </x-primary-link>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full mb-2 border-b pb-2">
            <div class="md:col-span-3 overflow-hidden min-h-0 flex flex-wrap justify-between">
                <h2 class="text-xl">{{ __('Records') }}</h2>
                @can('create', [\App\Models\Record::class, $experiment])
                    <x-icon-link title="{{ __('Add record') }}" name="plus" variant="outline" class="cursor-pointer bg-emerald-500 hover:bg-emerald-600" type="link" data-bs-toggle="modal" data-bs-target="#createRecord" />
                @endcan
            </div>
            <div class="w-full my-2">
                @foreach($experiment->parentActions() as $action)
                    @foreach($action->newestRecords as $record)
                        <div class="flex flex-wrap justify-between rounded-lg p-2 my-2 bg-white shadow-lg">
                            <div class="flex flex-wrap justify-start ">
                                <div class="font-bold mr-4">{{ $record->date->format('j.n.Y') }}</div>
                                <div class="font-bold mr-4">{{ $action->name }}</div>
                                @foreach($action->fields as $field)
                                    <div class="mr-4">
                                        {{ $field['name'] }}:
                                        <span class="font-bold">
                                            {{ $record->data[$field['name']] }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex flex-wrap">
                                @can('create', [\App\Models\Record::class, $experiment])
                                    <x-icon-link title="{{ __('Add record') }}" name="plus" variant="mini" class="cursor-pointer hover:bg-emerald-300 mr-1" type="link" data-bs-toggle="modal" data-bs-target="#createRecord" />
                                @endcan
                                @can('update', [$record, $experiment])
                                    <x-icon-link title="{{ __('Edit record') }}" name="pencil" variant="mini" class="cursor-pointer hover:bg-amber-300 mr-1" type="link" data-bs-toggle="modal" data-bs-target="#editRecord" />
                                @endcan
                                @can('delete', [$record, $experiment])
                                    <x-icon-link title="{{ __('Delete record') }}" name="trash" variant="mini" class="cursor-pointer hover:bg-red-400" type="link" data-bs-toggle="modal" data-bs-target="#deleteRecord" />
                                @endcan
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    @can('create', [\App\Models\Record::class, $experiment])
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createRecord" tabindex="-1" aria-labelledby="CreateRecord" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLongLabel">
                            {{ __('Create Record') }}
                        </h5>
                        <button type="button"
                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer p-4 border-t border-gray-200 rounded-b-md">
                        <livewire:record.forms.create :experiment="$experiment"/>
                    </div>
                </div>
            </div>
        </div>
    @endif
</main>
