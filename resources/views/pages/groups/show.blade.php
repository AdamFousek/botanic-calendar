<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $group['name'] }}
        </h2>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-wrap justify-end">
            <x-primary-link href="{{ route('groups.edit', $group['uuid']) }}" type="button-outline-sm">
                {{ __('Edit group') }}
            </x-primary-link>
        </div>
    </x-slot>

    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full grid grid-cols-1 items-start auto-rows-min md:grid-cols-6 gap-4 mb-4">
                <div class="bg-white md:col-span-4 overflow-hidden min-h-0 shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $group['description'] }}
                    </div>
                </div>
                <div class="bg-white md:col-span-2 overflow-hidden min-h-0 shadow-sm sm:rounded-lg">
                    <x-groups.members :members="$group['members']" :canInviteMember="$canInviteMember" class="p-6 bg-white border-b border-gray-200"></x-groups.members>
                </div>
            </div>
            <x-groups.projects :projects="$group['projects']"></x-groups.projects>
        </div>
    </div>
    <x-groups.invite-member :uuid="$group['uuid']"></x-groups.invite-member>
    <x-groups.create-project :group="$group"></x-groups.create-project>
</x-app-layout>
