@props(['project', 'experiments'])

@foreach($experiments as $experiment)
    <x-primary-link :href="route('experiment.show', [$project, $experiment])" type="link">
        <div class="bg-white p-4 my-2 overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200 hover:shadow-lg flex flex-wrap justify-between">
            <div class="flex flex-wrap items-center">
                <span class="h-4 w-4 rounded-full" style="background-color: {{ $experiment->color }}"></span>
                <span class="ml-4">{{ $experiment->name }}</span>
            </div>
            <span class="text-black">{{ $experiment->created_at }}</span>
        </div>
    </x-primary-link>
@endforeach