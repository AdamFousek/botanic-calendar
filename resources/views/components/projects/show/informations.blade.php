@props(['project', 'group', 'members'])

<div class="col-start-1 md:col-start-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
    <h4 class="text-lg border-b mb-2">{{ __('Information') }}</h4>
    <div class="flex flex-col">
        <div class="mb-2">
            <span class="text-sm font-bold mr-2">{{ __('Created at') }}: </span>
            <span class="text-sm">{{ $project['createdAt'] }}</span>
        </div>
        <div class="mb-2">
            <span class="font-bold mr-2">{{ __('Owner') }}: </span>
            <x-primary-link href="{{ route('user.show', $project['author']['id']) }}" type="link">
                {{ $project['author']['fullName'] ?: $project['author']['username'] }}
            </x-primary-link>
        </div>
        <div class="mb-2">
            <span class="font-bold mr-2">{{ __('Group') }}: </span>
            <x-primary-link href="{{ route('groups.show', $group['uuid']) }}" type="link">
                {{ $group['name'] }}
            </x-primary-link>
        </div>
        <div class="mb-2">
            <span class="font-bold mr-2">{{ __('Members') }}: </span>
            <ul class="pl-2">
                @foreach($members as $member)
                    <li class="flex flex-wrap justify-between">
                        <x-primary-link :href="route('user.show', $member['username'])" type="link">
                            {{ $member['fullName'] ?: $member['username'] }}
                        </x-primary-link>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>