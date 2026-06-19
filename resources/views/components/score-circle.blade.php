@props(['score' => 0])

@php
$color = $score >= 70 ? 'var(--color-success)' : ($score >= 40 ? 'var(--color-warning)' : 'var(--color-danger)');
$circumference = 2 * pi() * 29;
$offset = $circumference * (1 - min(max($score, 0), 100) / 100);
@endphp

<div {{ $attributes->merge(['style' => 'display:inline-flex;align-items:center;justify-content:center;position:relative;']) }}>
    <svg width="64" height="64" viewBox="0 0 64 64" style="transform:rotate(-90deg);">
        <circle cx="32" cy="32" r="29" fill="none" stroke="#E5E7EB" stroke-width="6"/>
        <circle cx="32" cy="32" r="29" fill="none" stroke="{{ $color }}" stroke-width="6" stroke-linecap="round"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $offset }}"/>
    </svg>
    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
        <span style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);">{{ $score }}</span>
    </div>
</div>
