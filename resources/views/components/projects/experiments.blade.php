@props(['project', 'experiments'])

@foreach($experiments as $experiment)
    <div class="bg-white p-4 my-2 overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <x-primary-link :href="route('experiment.show', [$project, $experiment])" type="link">
            {{ $experiment->name }}
        </x-primary-link>
    </div>
@endforeach