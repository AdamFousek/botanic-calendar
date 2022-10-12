<x-app-layout>
    <x-slot name="actions">
        @if(Auth::user()->id === $user->id)
            <div class="flex flex-wrap justify-end">
                <x-primary-link :type="'button-outline-sm'" href="{{ route('user.edit', $user) }}" class="text-sm">
                    Edit profile
                </x-primary-link>
            </div>
        @endif
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex-col flex justify-between md:flex-row">
            <div class="flex-1 flex md:self-start bg-white shadow-lg rounded-lg my-2">
                <div class="mr-4">
                    <img alt="..." src="https://via.placeholder.com/150" class="h-auto align-middle border-none"
                        style="max-width: 150px;"/>
                </div>
                <div class="flex flex-col">
                    <h2 class="text-3lx">{{ $user->fullName }}</h2>
                    <h3 class="text-xl">{{ $user->username }}</h3>
                </div>
            </div>
            <div class="my-2 px-6 md:w-1/4 md:ml-4 bg-white shadow-lg rounded-lg">
                <div class="flex flex-col">
                    <div class="">
                        <h3 class="text-xl border-b my-2">Groups</h3>
                        <ul>
                            <li>Group name asda sdasd asd asd asd asd sdad asd adadasd asd asd asd asda dad</li>
                        </ul>
                    </div>
                    <div class="">
                        <h3 class="text-xl border-b my-2">Projects</h3>
                        <ul>
                            @forelse($user->projects()->get() as $project)
                                <li>{{ $project->name }}</li>
                            @empty
                                <li>No projects</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
