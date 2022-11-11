@props(['project'])

<div class="col-auto p-2 md:p-4 mb-2 md:m-0 self-start rounded-lg bg-white shadow-sm sm:rounded-lg">
    <div class="flex flex-wrap justify-between">
        <div class="flex flex-1 flex-col mb-2">
            <span class="text-lg md:text-xl">{{ $project['name'] }}</span>
            <span class="text-gray-500 text-xs"> {{ $project['createdAt'] }}</span>
        </div>
        <div class="">
            <x-badge :color="'green'">{{ __('Project') }}</x-badge>
        </div>
    </div>
    <div class="border-t pt-2">
        @if (isset($project['group']))
            <x-primary-link class="py-0 px-0" href="{{route('groups.show', $project['group']['uuid']) }}">
                <x-badge :color="'rose'" class="rounded-sm">{{ $project['group']['name'] }}</x-badge>
            </x-primary-link>
        @endif
        <div class="text-sm my-2">{{ $project['description'] }}</div>
        <div class="flex justify-between">
        <x-primary-link href="{{route('user.show', $project['author']['username']) }}" type="link" class="flex flex-wrap items-center">
            @if ($project['author']['imagePath'] !== '')
            <img alt="{{ $project['author']['username'] }}" src="{{ $project['author']['imagePath'] }}" class="h-8 w-8 rounded-full"/>
            @endif
            <span class="ml-2">{{ $project['author']['username'] }}</span>
        </x-primary-link>
        <x-primary-link href="{{ route('projects.show', $project['uuid']) }}" type="button-outline-sm">{{ __('Show project') }}</x-primary-link>
        </div>
    </div>
</div>