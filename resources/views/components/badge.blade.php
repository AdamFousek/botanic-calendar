@props(['color' => ''])

@php
    $classes = match($color) {
        'pink' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-pink-200 uppercase last:mr-0 mr-1',
        'violet' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-violet-600 bg-violet-200 uppercase last:mr-0 mr-1',
        'blue' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1',
        'cyan' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-cyan-600 bg-cyan-200 uppercase last:mr-0 mr-1',
        'emerald' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1',
        'green' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 uppercase last:mr-0 mr-1',
        'yellow' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-yellow-600 bg-yellow-200 uppercase last:mr-0 mr-1',
        'orange' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-orange-600 bg-orange-200 uppercase last:mr-0 mr-1',
        'red' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-200 uppercase last:mr-0 mr-1',
        'rose' => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-rose-600 bg-rose-200 uppercase last:mr-0 mr-1',
        default => 'text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-200 uppercase last:mr-0 mr-1',
    }
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</span>