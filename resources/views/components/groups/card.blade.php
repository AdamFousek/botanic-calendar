@props(['group'])

<div class="col-auto p-2 md:p-4 mb-2 md:m-0 rounded-lg bg-white shadow-sm sm:rounded-lg">
    <div class="flex flex-col mb-4">
        <span class="text-lg md:text-xl">{{ $group->name }}</span>
        <span class="text-gray-500 text-xs"> {{ $group->created_at }}</span>
    </div>
    <div class=" mb-4">
        <x-primary-link href="{{route('user.show', $group->user)}}" type="link" class="flex flex-wrap items-center">
            <div class="mr-2">
                <img alt="{{ $group->user->username }}" src="https://via.placeholder.com/30" class="h-8 w-8 rounded-full"/>
            </div>
            {{ $group->user->username }}
        </x-primary-link>
    </div>
    <div class="border-t flex justify-end pt-4">
        <x-primary-link href="{{ route('groups.show', $group) }}" type="button-outline-sm">{{ __('Show project') }}</x-primary-link>
    </div>
</div>