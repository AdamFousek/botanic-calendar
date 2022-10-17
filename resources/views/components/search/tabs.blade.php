@props(['groups', 'projects'])

<div class="">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="searchTabs" data-tabs-toggle="#searchTabContent" role="tablist">
        <li class="mr-2" role="presentation">
            <button class="search-tab inline-block p-4 cursor-pointer rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 text-gray-500 border-gray-100" id="groups-tab" data-tabs-target="groups-content" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                {{ __('Groups') }} ({{ $groups->count() }})
            </button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="search-tab inline-block p-4 cursor-pointer rounded-t-lg border-b-2 text-emerald-600 hover:text-emerald-600 border-emerald-600" id="projects-tab" data-tabs-target="projects-content" type="button" role="tab" aria-controls="profile" aria-selected="true">¨
                {{ __('Projects') }} ({{ $projects->count() }})
            </button>
        </li>
    </ul>
</div>
<div id="searchTabContent">
    <div class="search-tab-content p-4 rounded-lg" id="groups-content" role="tabpanel" aria-labelledby="groups-tab">
        @if (!$groups->isEmpty())
            <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($groups as $group)
                    <x-groups.card :group="$group"></x-groups.card>
                @endforeach
            </div>
        @else
            <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">There is no projects found. You can search for public projects</div>
        @endif
    </div>
    <div class="search-tab-content hidden p-4 rounded-lg" id="projects-content" role="tabpanel" aria-labelledby="projects-tab">
        @if (!$projects->isEmpty())
            <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($projects as $project)
                    <x-projects.card :project="$project"></x-projects.card>
                @endforeach
            </div>
        @else
            <div class="w-full rounded-lg shadow-sm sm:rounded-lg text-center bg-white py-4">There is no projects found. You can search for public projects</div>
        @endif
    </div>
</div>
