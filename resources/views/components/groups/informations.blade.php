@props(['group', 'members'])

<div class="col-start-1 md:col-start-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
    <div class="flex flex-wrap justify-between border-b mb-2">
        <h4 class="text-lg">{{ __('Group information') }}</h4>
        <livewire:group.actions.favourite-group :uuid="$group->uuid"/>
    </div>
    <div class="flex flex-col">
        <div class="mb-2">
            <span class="text-sm font-bold mr-2">{{ __('Created at') }}: </span>
            <span class="text-sm">{{ $group->created_at->format('j.n.Y') }}</span>
        </div>
        <div class="mb-2">
            <span class="font-bold mr-2">{{ __('Owner') }}: </span>
            <x-primary-link href="{{ route('user.show', $group->user->username) }}" type="link">
                {{ $group->user->fullName ?: $group->user->username }}
            </x-primary-link>
        </div>
        <div class="mb-2">
            <div class="flex flex-wrap justify-between border-b my-2">
                <span class="font-bold mr-2">{{ __('Members') }}: </span>
                @can('inviteMember', $group)
                    <x-primary-link class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#inviteMember">{{ __('Invite') }}</x-primary-link>
                @endcan
            </div>
            <ul class="pl-2">
                @foreach($group->members as $member)
                    <li class="flex flex-wrap justify-between">
                        <x-primary-link href="{{ route('user.show', $member->username) }}" type="link">
                            {{ $member->fullName ?: $member->username }}
                        </x-primary-link>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

