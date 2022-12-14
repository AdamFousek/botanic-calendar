<div class="overflow-hidden min-h-0">
    <div class="overflow-hidden border-b border-gray-200">
        <div class="flex flex-wrap flex justify-between mb-2">
            <h3 class="text-lg">{{ __('Experiment actions') }}</h3>
            <div class="flex flex-wrap">
                <x-primary-button color="yellow">{{ __('Export actions') }}</x-primary-button>
                <x-primary-link :href="route('experiment.actions.create', [$experiment->project, $experiment])" type="button-outline-sm">
                    {{ __('Create Action') }}
                </x-primary-link>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="min-w-full text-left">
                <thead class="border-b bg-white">
                <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                        {{ __('Action name') }}
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                        {{ __('Fields') }}
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                        {{ __('Notifications') }} ({{ __('in days') }})
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($actions as $action)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $action['name'] }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                            <ul>
                            @foreach($action['fields'] as $field)
                                <li>{{ $field['name'] }} <span class="text-sm">({{ $field['type'] }})</span>
                                @if($field['type'] === 'select')
                                    <ul class="px-2">
                                        @foreach($field['options'] as $option)
                                            <li>{{$option['option']}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                </li>
                            @endforeach
                            </ul>
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                            {{ implode(', ', $action['notifications']) }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                            <x-primary-link
                                type="link"
                                :href="route('experiment.actions.createSubAction', [$experiment->project, $experiment, $action['id']])">
                                {{ __('Add sub action') }}
                            </x-primary-link>
                            <x-primary-button color="red">{{ __('Delete Action') }}</x-primary-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>