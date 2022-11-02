@props(['members', 'canInviteMember'])

<div {{ $attributes }}>
    <div class="flex flex-wrap justify-between border-b my-2">
        <h3 class="text-xl">{{ __('Members') }}</h3>
        @if($canInviteMember)
            <x-primary-link class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#inviteMember">{{ __('Invite') }}</x-primary-link>
        @endif
    </div>
    <ul>
        @foreach($members as $member)
            <li class="flex flex-wrap justify-between">
                <x-primary-link :href="route('user.show', $member['username'])" type="link">
                    {{ $member['fullName'] ?: $member['username'] }}
                </x-primary-link>
                @if($member['isAdmin']) <x-badge color="orange">{{ __('Admin') }}</x-badge> @endif
            </li>
        @endforeach
    </ul>
</div>
