<main class="py-2 md:py-6">
    <x-slot name="header">
        <div class="flex flex-wrap justify-center items-center md:justify-between">
        </div>
    </x-slot>

    <x-slot name="actions">
        @can('update', $user)
            <div class="flex flex-wrap justify-end">
                <x-primary-link :type="'button-outline-sm'" href="{{ route('user.edit', $user->username) }}" class="text-sm">
                    {{ __('Edit profile') }}
                </x-primary-link>
            </div>
        @endcan
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex-col flex justify-between md:flex-row">
            <div class="flex-1 flex justify-between bg-white shadow-lg rounded-lg mb-4">
                <div class="flex flex-col p-4 ">
                    <h2 class="text-3xl">{{ $user->fullName }}</h2>
                    <h3 class="text-xl">{{ $user->username }}</h3>
                </div>
                <div class="m-0">
                    <img alt="{{ $user->fullName ?: $user->username }}" src="{{ asset($user->image) }}" class="h-auto align-middle border-none"
                         style="width: 150px; height: 150px"/>
                </div>
            </div>
        </div>


        <div class="flex flex-wrap justify-between items-start">
            <div class="flex-1 mb-4 p-4 bg-white shadow-lg rounded-lg mr-2">
                <x-user.projects :projects="$user->projects"></x-user.projects>
            </div>
            <div class="flex-1 mb-4 p-4 bg-white shadow-lg rounded-lg">
                <x-user.groups :groups="$user->groups"></x-user.groups>
            </div>
        </div>

    </section>
</main>
