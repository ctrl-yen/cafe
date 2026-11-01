@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-sage-500 text-start text-base font-semibold text-sage-800 bg-sage-100 transition'
            : 'block w-full ps-4 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold text-espresso-700 hover:bg-cream-200 hover:border-cream-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
