@props(['groups'])


<div>
    <h3 class="text-xl border-b my-2">Groups</h3>
    <ul>
        @forelse($groups as $group)
            <li>
                <x-primary-link :href="route('groups.show', $group)" type="link">{{ $group->name }}</x-primary-link>
            </li>
        @empty
            <li>No groups yet! <x-primary-link href="{{ route('projects.create') }}" type="link">Create one!</x-primary-link></li>
        @endforelse
    </ul>
</div>