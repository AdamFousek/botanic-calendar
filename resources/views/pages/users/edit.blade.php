<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user['fullName'] ?: $user['username'] }}
        </h2>
    </x-slot>

    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl">{{ __('Edit') }}</h2>
                    <livewire:user.forms.edit-user :userId="$user['id']"/>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
