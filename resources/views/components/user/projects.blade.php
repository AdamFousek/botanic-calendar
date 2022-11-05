@props(['projects', 'projectsCount', 'canEditUser'])

<div>
    <h3 class="text-xl border-b mb-2">Projects <span class="text-base text-gray-500">({{ $projectsCount }})</span></h3>
    <ul>
        @forelse($projects as $project)
            <li>
                <x-primary-link :href="route('projects.show', $project['uuid'])" type="link">{{ $project['name'] }}</x-primary-link>
            </li>
        @empty
            <li>
                {{ __('No projects yet!') }}
                @if($canEditUser)
                    <x-primary-link href="{{ route('projects.create') }}" type="link">Create one!</x-primary-link>
                @endif
            </li>
        @endforelse
    </ul>
</div>