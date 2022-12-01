@props(['groups'])


<div>
    <h3 class="text-xl border-b mb-2">Groups <span class="text-base text-gray-500">({{ $groups->count() }})</span></h3>
    <ul>
        @forelse($groups as $group)
            <li>
                <x-primary-link :href="route('groups.show', $group['uuid'])" type="link">{{ $group->name }}</x-primary-link>
            </li>
        @empty
            <li>
                {{ __('No groups yet!') }}}
                @can('update', $user)
                    <x-primary-link href="{{ route('groups.create') }}" type="link">Create one!</x-primary-link>
                @endcan
            </li>
        @endforelse
    </ul>
</div>