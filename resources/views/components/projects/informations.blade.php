@props(['project'])

<div class="col-start-1 md:col-start-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
    <div class="flex flex-wrap justify-between border-b mb-2">
        <h4 class="text-lg">{{ __('Project information') }}</h4>
        <livewire:project.actions.favourite-project :project="$project"/>
    </div>
    <div class="flex flex-col">
        <div class="mb-2">
            <span class="text-sm font-bold mr-2">{{ __('Created at') }}: </span>
            <span class="text-sm">{{ $project->created_at->format('j.n.Y') }}</span>
        </div>
        <div class="mb-2">
            <span class="font-bold mr-2">{{ __('Owner') }}: </span>
            <x-primary-link href="{{ route('user.show', $project->user->username) }}" type="link">
                {{ $project->user->fullName ?: $project->user->username }}
            </x-primary-link>
        </div>
        <div class="mb-2">
            @if ($project->group)
            <span class="font-bold mr-2">{{ __('Group') }}: </span>
            <x-primary-link href="{{ route('groups.show', $project->group->uuid) }}" type="link">
                {{ $project->group->name }}
            </x-primary-link>
            @endif
        </div>
        <div class="mb-2">
            <span class="font-bold mr-2">{{ __('Members') }}: </span>
            <ul class="pl-2">
                @foreach($project->members as $member)
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