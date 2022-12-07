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
                {{ __('Experiment settings') }}
            @endif
        </div>
    </div>
</main>
