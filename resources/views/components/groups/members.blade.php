@props(['members'])

<div {{ $attributes }}>
    <div class="flex flex-wrap justify-between border-b my-2">
        <h3 class="text-xl">{{ __('Members') }}</h3>
        <x-primary-link class="cursor-pointer" type="link" data-bs-toggle="modal" data-bs-target="#inviteMember">{{ __('Invite') }}</x-primary-link>
    </div>
    <ul>
        @foreach($members as $member)
            <li>
                <x-primary-link :href="route('user.show', $member['username'])" type="link">{{ $member['fullName'] ?: $member['username'] }}</x-primary-link>
            </li>
        @endforeach
    </ul>
</div>
