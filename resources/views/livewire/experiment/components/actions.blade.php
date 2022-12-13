<div class="overflow-hidden min-h-0">
    <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <div class="flex flex-wrap flex justify-between">
            <h3 class="text-lg">{{ __('Experiment actions') }}</h3>
            <div class="flex flex-wrap">
                <x-primary-button color="yellow">{{ __('Export actions') }}</x-primary-button>
                <x-primary-link :href="route('experiment.actions.create', [$experiment->project, $experiment])" type="button-outline-sm">
                    {{ __('Create Action') }}
                </x-primary-link>
            </div>
        </div>
        @foreach($experiment->actions as $action)
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h4 class="font-bold">{{ __('Actions') }}</h4>
                    <ul class="px-2">
                        @foreach($settings->actions as $action)
                            <li>{{ $action['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold">{{ __('Fields') }}</h4>
                    <ul class="px-2">
                        @foreach($settings->fields as $field)
                            <li>
                                {{ $field['name'] }}
                                <span class="text-sm">
                                                ({{ $field['type'] }})
                                            </span>
                                @if($field['type'] === 'select')
                                    <ul class="px-2">
                                        @foreach($field['fields'] as $option)
                                            <li>{{$option['option']}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold">{{ __('Notifications') }}</h4>
                    <ul class="px-2">
                        @foreach($settings->notifications as $notification)
                            <li>
                                {{ $notification['action'] }}
                                <span class="text-sm">
                                                ({{ $notification['days'] }})
                                            </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>