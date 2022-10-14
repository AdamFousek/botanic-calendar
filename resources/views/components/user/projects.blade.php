@props(['projects'])

<div class="">
    <h3 class="text-xl border-b my-2">Projects</h3>
    <ul>
        @forelse($projects as $project)
            <li>
                <x-primary-link :href="route('projects.show', $project)" type="link">{{ $project->name }}</x-primary-link>
            </li>
        @empty
            <li>No projects yet! <x-primary-link href="{{ route('projects.create') }}" type="link">Create one!</x-primary-link></li>
        @endforelse
    </ul>
</div>