<div class="mt-4">
    <x-input-label for="members" :value="__('Project members with access')" />
    @if ($members !== [])
        <div class="my-2">
            @foreach($members as $member)
                <x-badge wire:click="toggleMembers({{ $member['id'] }})" class="cursor-pointer">
                    {{ $member['fullName'] ?: $member['username'] }}
                </x-badge>
            @endforeach
        </div>
    @endif
    <x-text-input wire:model.debounce.300ms="username" class="block mt-1 w-full" type="text" placeholder="{{ __('Search for specific member...') }}" />

    <div class="block mt-2">
        <label for="allMembers" class="inline-flex items-center">
            <input wire:model.lazy="allMembers" id="allMembers" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
            <span class="ml-2 text-sm text-gray-600">{{ __('Add all members') }}</span>
        </label>
    </div>

    @if ($filteredUsers !== [])
        <div class="overflow-y-auto max-h-28 px-2">
            @foreach($filteredUsers as $user)
                <x-primary-link wire:click="toggleMembers({{ $user['id'] }})" type="link" class="cursor-pointer block">
                    {{ $user['fullName'] ?: $user['username'] }}
                </x-primary-link>
            @endforeach
        </div>
    @endif
</div>
