@props(['variant' => 'neutral'])

@php
$class = match ($variant) {
    'success' => 'badge-success',
    'warning' => 'badge-warning',
    'danger' => 'badge-danger',
    'blue' => 'badge-blue',
    default => 'badge-neutral',
};
@endphp

<span {{ $attributes->merge(['class' => "badge $class"]) }}>
    {{ $slot }}
</span>
