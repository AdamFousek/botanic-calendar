@props(['name' => 'pencil', 'variant' => 'mini'])

<a {{ $attributes->merge(['class' => 'p-1 inline-block rounded-lg border']) }}>
    <x-icon name="{{ $name }}" variant="{{ $variant }}"/>
</a>
