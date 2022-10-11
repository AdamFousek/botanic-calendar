<x-app-layout>
    <section class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-12">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-6/12 px-4 lg:order-2 flex justify-start">
                            <div class="relative">
                                <img
                                        alt="..."
                                        src="https://via.placeholder.com/150"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16"
                                        style="max-width: 150px;"
                                />
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4 lg:order-3 lg:text-right lg:self-center">
                            <div class="py-6 px-3 mt-32 sm:mt-0">
                                <a class="text-pink-500 border border-pink-500 hover:bg-pink-500 hover:text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="{{ route('user.edit', $user) }}">
                                    {{ __('Edit profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-12">
                        <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2">
                            {{ $user->fullName }}
                        </h3>
                        <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                            {{ $user->username }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
