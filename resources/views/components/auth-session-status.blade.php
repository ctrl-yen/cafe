@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-xl bg-sage-100 px-4 py-3 text-sm font-semibold text-sage-800']) }}>
        {{ $status }}
    </div>
@endif
