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
            <x-primary-link href="{{ route('experiment.show', [$experiment->project, $experiment]) }}" type="button-outline-sm" class="mr-2">
                {{ __('Back to experiment') }}
            </x-primary-link>
            @if($experimentSettings === null)
                <x-primary-link href="{{ route('experiment.settings.create', [$experiment->project, $experiment]) }}" type="button-outline-sm">
                    {{ __('Add settings') }}
                </x-primary-link>
            @endif
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full grid grid-cols-1 items-start gap-4 mb-4">
            <livewire:experiment.forms.edit-experiment :experiment="$experiment"/>
            @if($experimentSettings)
                <div class="overflow-hidden min-h-0">
                    <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                        <div class="flex flex-wrap flex justify-between">
                            <h3 class="text-lg">{{ __('Experiment settings') }}</h3>
                            <div class="flex flex-wrap">
                                <x-primary-button color="yellow">{{ __('Export settings') }}</x-primary-button>
                                <x-primary-link href="{{ route('experiment.settings.edit', [$experiment, $experimentSettings]) }}" type="button-outline-sm">
                                    {{ __('Edit') }}
                                </x-primary-link>
                            </div>
                        </div>
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
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
