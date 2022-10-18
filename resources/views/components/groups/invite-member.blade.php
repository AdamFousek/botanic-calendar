@props(['group'])

<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="inviteMember" tabindex="-1" aria-labelledby="InviteMember" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLongLabel">
                    {{ __('Invite User') }}
                </h5>
                <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('groups.inviteMember', $group) }}" method="POST">
                @csrf
                <div class="modal-body relative p-4">
                    <div>
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <x-primary-button data-bs-dismiss="modal" color="red-outline" type="''">
                        {{ __('Close') }}
                    </x-primary-button>
                    <x-primary-button data-bs-dismiss="modal">
                        {{ __('Send invitation') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>