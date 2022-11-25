@props(['projects' => [], 'canCreateProject' => false])

<div class="flex flex-wrap justify-between border-b mb-4">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
        {{ __('Projects') }}
    </h2>
    @if($canCreateProject)
        <x-primary-link type="link" class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#createProject">
            {{ __('Create Project') }}
        </x-primary-link>
    @endif
</div>
@if ($projects !== [])
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($projects as $project)
            <x-projects.card :project="$project"></x-projects.card>
        @endforeach
    </div>
@else
    <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">
        {{ __('There is no projects found.')}}
    </div>
@endif