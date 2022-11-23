<div>
    <div class="flex flex-wrap justify-between border-b my-2">
        <h3 class="text-xl">{{ __('Favourite Projects') }}</h3>
    </div>
    <ul>
        @foreach($favouriteProjects as $project)
            <li class="flex flex-wrap justify-between">
                <x-primary-link :href="route('projects.show', $project['uuid'])" type="link">
                    {{ $project['name'] }}
                </x-primary-link>
            </li>
        @endforeach
    </ul>
</div>
