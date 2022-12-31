<div>
    <div class="p-2 flex flex-wrap justify-between">
        <div class="flex flex-wrap justify-start">
            <div class="">

            </div>
            <div class="mb-2 mr-3">
                <x-input-label for="date" :value="__('Date')" />
                <x-text-input wire:model.lazy="date" id="date" class="" type="date" name="date" />
            </div>
            <div class="mb-2 mr-3">
                <x-input-label for="action" :value="__('Action')" />
                <select wire:model.lazy="actionId" id="actionId"
                        class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56">
                    <option value="0">{{ __('All') }}</option>
                    @foreach($experiment->actions as $action)
                        <option value="{{ $action->id }}">{{ $action->name  }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="w-full my-2">
        @foreach($records as $record)
            @include('livewire/experiment/components/part/record', ['record' => $record])
        @endforeach
    </div>
</div>