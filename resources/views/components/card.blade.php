@props(['header' => '', 'padding' => true])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @if ($header)
        <div style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);padding:16px 20px 0;">
            {{ $header }}
        </div>
        <div style="font-family:var(--font-sans);font-size:12.5px;font-style:italic;color:var(--color-text-muted);padding:2px 20px 12px;">
            {{ $subtitle ?? '' }}
        </div>
    @endif
    @if ($padding)
        <div style="padding:20px;">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</div>
