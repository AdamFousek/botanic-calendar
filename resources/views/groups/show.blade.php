<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $group['name'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full grid grid-cols-1 items-start auto-rows-min md:grid-cols-6 md:grid-rows-2 gap-4">
                <div class="bg-white md:col-span-4 overflow-hidden min-h-0 shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $group['description'] }}
                    </div>
                </div>
                <div class="bg-white md:col-span-2 overflow-hidden min-h-0 shadow-sm sm:rounded-lg">
                    <x-groups.members :members="$group['members']" class="p-6 bg-white border-b border-gray-200"></x-groups.members>
                </div>
                <div class="row-start-2 md:col-span-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Projects') }}
                    </h2>
                    @if ($group['projects'] !== [])
                        <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($group['projects'] as $project)
                                <x-projects.card :project="$project"></x-projects.card>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">There is no projects found. You can create new project here.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-groups.invite-member :group="$group['uuid']" />
</x-app-layout>
