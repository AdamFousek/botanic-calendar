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
                        {{ __('Parent') }}
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
                        @include('livewire/experiment/components/part/action', ['action' => $action, 'layer' => 0])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>