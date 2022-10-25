@props(['message'])

<div class="text-white px-6 py-4 border-0 rounded relative bg-emerald-500">
    <span class="inline-block align-middle mr-8">
        {{ $message }}
    </span>
    <button data-alert-close="success" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
        <span>×</span>
    </button>
</div>