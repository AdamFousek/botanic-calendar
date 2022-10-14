@props(['project', 'prefix' => 'projects'])

<div class="col-auto p-2 md:p-4 mb-2 md:m-0 rounded-lg bg-white shadow-sm sm:rounded-lg">
    <div class="flex flex-col mb-2">
        <span class="text-lg md:text-xl">{{ $project->name }}</span>
        <span class="text-gray-500 text-xs"> {{ $project->created_at }}</span>
    </div>
    <div class=" mb-4">
        <x-badge :color="'green'">{{ __('Project') }}</x-badge>
    </div>
    <div class="border-t flex justify-between pt-4">
        <x-primary-link href="{{route('user.show', $project->user)}}" type="link" class="flex flex-wrap items-center">
            <img alt="{{ $project->user->username }}" src="https://via.placeholder.com/30" class="h-8 w-8 rounded-full"/>
        </x-primary-link>
        <x-primary-link href="{{ route($prefix.'.show', $project) }}" type="button-outline-sm">{{ __('Show project') }}</x-primary-link>
    </div>
</div>