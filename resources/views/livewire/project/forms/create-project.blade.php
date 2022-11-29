<form wire:submit.prevent="create">
    @csrf

    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="projectName" :value="__('Project name')" />

        <x-text-input wire:model.lazy="projectName" id="name" class="block mt-1 w-full" type="text" name="projectName" :value="old('projectName')" autofocus />

        @error('projectName')
            <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    <div class="block mt-4">
        <label for="isPublic" class="inline-flex items-center">
            <input wire:model.lazy="isPublic" id="isPublic" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" name="is_public">
            <span class="ml-2 text-sm text-gray-600">{{ __('Is project public?') }}</span>
        </label>
    </div>

    <div class="mt-4">
        <x-input-label for="projectDescription" :value="__('Project description')" />

        <textarea wire:model.lazy="projectDescription" name="projectDescription" id="description" class="w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">{{ old('description') }}</textarea>

        @error('projectDescription')
            <x-input-error :messages="$message" class="mt-2" />
        @enderror
    </div>

    @if ($groupUuid)
    <div class="mt-4">
        <x-input-label for="members" :value="__('Project members with access')" />

        @if ($members !== [])
            <div class="my-2">
                <h4 class="text-lg">{{ __('Selected members:') }}</h4>
                @foreach($members as $member)
                    <x-badge wire:click="toggleMembers({{ $member['id'] }})" class="cursor-pointer">
                        {{ $member['fullName'] ?: $member['username'] }}
                    </x-badge>
                @endforeach
            </div>
        @endif

        <x-text-input wire:model.debounce.300ms="username" class="block mt-1 w-full" type="text" placeholder="{{ __('Search for specific member...') }}" />

        <input wire:model.lazy="allMembers" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
        <span class="ml-2 text-sm text-gray-600">{{ __('Add all members') }}</span>

        @if ($filteredUsers !== [])
        <div class="my-2 overflow-y-auto h-28">
            @foreach($filteredUsers as $user)
                <x-primary-link wire:click="toggleMembers({{ $user['id'] }})" type="link" class="cursor-pointer block">
                    {{ $user['fullName'] ?: $user['username'] }}
                </x-primary-link>
            @endforeach
        </div>
        @endif


    </div>
    @endif

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ml-4">
            {{ __('Create Project') }}
        </x-primary-button>
    </div>
</form>