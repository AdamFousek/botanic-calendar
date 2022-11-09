<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
        </div>
    </x-slot>

    <x-slot name="actions">
        @if($canEditUser)
            <div class="flex flex-wrap justify-end">
                <x-primary-link :type="'button-outline-sm'" href="{{ route('user.edit', $user['username']) }}" class="text-sm">
                    {{ __('Edit profile') }}
                </x-primary-link>
            </div>
        @endif
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex-col flex justify-between md:flex-row">
            <div class="flex-1 flex justify-between bg-white shadow-lg rounded-lg mb-4">
                <div class="flex flex-col p-4 ">
                    <h2 class="text-3xl">{{ $user['fullName'] }}</h2>
                    <h3 class="text-xl">{{ $user['username'] }}</h3>
                </div>
                <div class="m-0">
                    <img alt="..." src="{{ asset($user['image']) }}" class="h-auto align-middle border-none"
                         style="max-width: 150px;"/>
                </div>
            </div>
        </div>


        <div class="flex flex-wrap justify-between">
            <div class="flex-1 mb-4 p-4 bg-white shadow-lg rounded-lg mr-2">
                <x-user.projects
                    :projects="$user['projects']"
                    :projectsCount="$user['projectsCount']"
                    :canEditUser="$canEditUser"
                ></x-user.projects>
            </div>
            <div class="flex-1 mb-4 p-4 bg-white shadow-lg rounded-lg">
                <x-user.groups
                    :groups="$user['groups']"
                    :groupsCount="$user['groupsCount']"
                    :canEditUser="$canEditUser"
                ></x-user.groups>
            </div>
        </div>

    </section>
</x-app-layout>
