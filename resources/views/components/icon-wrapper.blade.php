@props(['name' => 'pencil', 'variant' => 'mini'])

<div {{ $attributes->merge(['class' => 'p-1']) }}>
    <x-icon name="{{ $name }}" variant="{{ $variant }}"/>
</div>
