@props(['project'])

<div class="col-auto p-2 md:p-4 mb-2 md:m-0 rounded-lg bg-white shadow-sm sm:rounded-lg">
    <div class="flex flex-col mb-4">
        <span class="text-lg md:text-xl">{{ $project->name }}</span>
        <span class="text-gray-500 text-xs"> {{ $project->created_at }}</span>
    </div>
    <div class="flex flex-wrap items-center mb-4">
        <div class="mr-2">
            <img alt="{{ $project->user->username }}" src="https://via.placeholder.com/30" class="h-8 w-8 rounded-full"/>
        </div>
        <x-primary-link href="{{route('user.show', $project->user)}}" type="link">{{ $project->user->username }}</x-primary-link>
    </div>
    <div class="border-t flex justify-end pt-4">
        <x-primary-link href="{{ route('projects.show', $project) }}" type="button-outline-sm">{{ __('Show project') }}</x-primary-link>
    </div>
</div>