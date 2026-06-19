@props(['variant' => 'primary', 'disabled' => false, 'type' => 'submit'])

@php
$variantClass = match ($variant) {
    'secondary' => 'btn-secondary',
    'ghost' => 'btn-ghost',
    default => 'btn-primary',
};
@endphp

<button {{ $attributes->merge(['type' => $type, 'disabled' => $disabled])->class(['btn', $variantClass]) }}>
    {{ $slot }}
</button>
