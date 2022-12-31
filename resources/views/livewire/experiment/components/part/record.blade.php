<div class="flex flex-wrap justify-between md:rounded-lg p-2 my-2 bg-white shadow-lg md:items-center">
    <div class="flex flex-wrap justify-start flex-col md:flex-row">
        <div class="font-bold mr-4">{{ $record->date->format('j.n.Y') }}</div>
        <div class="font-bold mr-4">{{ $record->action->name }}</div>
        @foreach($record->action->fields as $field)
            <div class="mr-4">
                {{ $field['name'] }}:
                <span class="font-bold">
                    {{ $record->data[$field['name']] }}
                </span>
            </div>
        @endforeach
    </div>
    <div class="flex flex-wrap self-start md:self-center">
        @if($record->action->subActions->count() > 0 && Auth::user()->can('create', [\App\Models\Record::class, $experiment]))
            <x-icon-link title="{{ __('Add record') }}" name="plus" variant="outline" class="cursor-pointer hover:bg-emerald-300 mr-1" type="link" data-bs-toggle="modal" data-bs-target="#createRecord_{{ $record->id }}" />
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createRecord_{{ $record->id }}" tabindex="-1" aria-labelledby="CreateRecord" aria-hidden="true">
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
                            <livewire:record.forms.create :experiment="$experiment" :parent="$record"/>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @can('update', [$record, $experiment])
            <x-icon-link title="{{ __('Edit record') }}" name="pencil" variant="outline" class="cursor-pointer hover:bg-amber-300 mr-1" type="link" data-bs-toggle="modal" data-bs-target="#editRecord_{{ $record->id }}" />
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="editRecord_{{ $record->id }}" tabindex="-1" aria-labelledby="CreateRecord" aria-hidden="true">
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
        @endcan
        @can('delete', [$record, $experiment])
            <x-icon-link title="{{ __('Delete record') }}" name="trash" variant="outline" class="cursor-pointer hover:bg-red-400" type="link" data-bs-toggle="modal" data-bs-target="#deleteRecord_{{ $record->id }}" />
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="deleteRecord_{{ $record->id }}" tabindex="-1" aria-labelledby="CreateRecord" aria-hidden="true">
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
        @endcan
    </div>
</div>
