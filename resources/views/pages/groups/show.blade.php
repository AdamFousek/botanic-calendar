<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ $group['name'] }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('groups.edit', $group['uuid']) }}" type="button-outline-sm">
                {{ __('Edit group') }}
            </x-primary-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full grid grid-cols-1 items-start md:grid-cols-4 gap-4 mb-4">
            <div class="md:col-span-3 overflow-hidden min-h-0">
                <div class="p-6 mb-4 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    {{ $group['description'] }}
                </div>
                <div class="w-full">
                    <x-groups.projects :projects="$group['projects']"></x-groups.projects>
                </div>
            </div>
            <div class="bg-white md:col-span-1 overflow-hidden min-h-0 shadow-sm sm:rounded-lg">
                <x-groups.members :members="$group['members']" :canInviteMember="$canInviteMember" class="p-6 bg-white border-b border-gray-200"></x-groups.members>
            </div>
        </div>
    </div>
    @if($canInviteMember)
        <x-groups.invite-member :uuid="$group['uuid']"></x-groups.invite-member>
    @endif
    <x-groups.create-project :group="$group"></x-groups.create-project>
</x-app-layout>
