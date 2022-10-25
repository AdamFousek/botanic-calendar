<x-app-layout>
    <x-slot name="actions">
        @if(Auth::user()->can('update', $user['id']))
            <div class="flex flex-wrap justify-end">
                <x-primary-link :type="'button-outline-sm'" href="{{ route('user.edit', $user) }}" class="text-sm">
                    Edit profile
                </x-primary-link>
            </div>
        @endif
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex-col flex justify-between md:flex-row">
            <div class="flex-1 flex md:self-start bg-white shadow-lg rounded-lg mb-4">
                <div class="mr-4">
                    <img alt="..." src="https://via.placeholder.com/150" class="h-auto align-middle border-none"
                        style="max-width: 150px;"/>
                </div>
                <div class="flex flex-col py-4">
                    <h2 class="text-3xl">{{ $user['fullName'] }}</h2>
                    <h3 class="text-xl">{{ $user['username'] }}</h3>
                </div>
            </div>
            <div class="mb-4 px-6 md:w-1/4 md:ml-4 bg-white shadow-lg rounded-lg">
                <div class="flex flex-col py-4">
                    <x-user.groups :groups="$user['groups']" :groupsCount="$user['groupsCount']"></x-user.groups>
                    <x-user.projects :projects="$user['projects']" :projectsCount="$user['projectsCount']"></x-user.projects>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
