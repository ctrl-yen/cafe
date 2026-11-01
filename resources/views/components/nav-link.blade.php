@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 rounded-full bg-sage-100 text-sage-800 text-sm font-semibold transition'
            : 'inline-flex items-center px-4 py-2 rounded-full text-espresso-700 text-sm font-semibold hover:bg-cream-200 hover:text-espresso-900 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
