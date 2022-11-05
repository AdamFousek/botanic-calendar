@props(['groups', 'groupsCount', 'canEditUser'])


<div>
    <h3 class="text-xl border-b mb-2">Groups <span class="text-base text-gray-500">({{ $groupsCount }})</span></h3>
    <ul>
        @forelse($groups as $group)
            <li>
                <x-primary-link :href="route('groups.show', $group['uuid'])" type="link">{{ $group['name'] }}</x-primary-link>
            </li>
        @empty
            <li>
                {{ __('No groups yet!') }}}
                @if($canEditUser)
                    <x-primary-link href="{{ route('groups.create') }}" type="link">Create one!</x-primary-link>
                @endif
            </li>
        @endforelse
    </ul>
</div>