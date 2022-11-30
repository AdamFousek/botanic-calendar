@props(['group'])

<div class="col-auto p-2 md:p-4 mb-2 md:m-0 self-start rounded-lg bg-white shadow-sm sm:rounded-lg">
    <div class="flex flex-wrap justify-between">
        <div class="flex flex-1 flex-col mb-2">
            <span class="text-lg md:text-xl">{{ $group->name }}</span>
            <span class="text-gray-500 text-xs"> {{ $group->created_at->format('j.n.Y') }}</span>
        </div>
        <div>
            <x-badge :color="'rose'">{{ __('Group') }}</x-badge>
        </div>
    </div>
    <div class="border-t">
        <div class="text-sm my-2">{{ $group->description }}</div>
        <div class="flex justify-between">
            <x-primary-link href="{{ route('user.show', $group->user->username) }}" type="link" class="flex flex-wrap items-center">
                @if ($group->user->image)
                    <img alt="{{ $group->user->fullName ?: $group->user->username }}" src="{{ asset($group->user->image) }}" class="h-8 w-8 rounded-full"/>
                @endif
                <span class="ml-2">{{ $group->user->fullName ?: $group->user->username }}</span>
            </x-primary-link>
            <x-primary-link href="{{ route('groups.show', $group->uuid) }}" type="button-outline-sm">{{ __('Show group') }}</x-primary-link>
        </div>
    </div>
</div>