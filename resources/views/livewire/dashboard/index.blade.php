<main class="py-2 md:py-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full grid grid-cols-1 items-start md:grid-cols-4 gap-4 mb-4">
            <div class="col-start-1 md:col-start-1 md:col-end-4">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                    {{ __('Calendar') }}
                </div>
            </div>
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                <livewire:dashboard.favourite-projects/>
            </div>
        </div>
    </div>
</main>
