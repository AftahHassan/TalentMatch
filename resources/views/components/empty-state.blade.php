@props(['title' => '', 'subtitle' => ''])

<div {{ $attributes->merge(['style' => 'display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 20px;text-align:center;']) }}>
    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" style="margin-bottom:16px;opacity:0.4;">
        <rect x="10" y="20" width="60" height="48" rx="6" stroke="var(--color-text-muted)" stroke-width="2" fill="none"/>
        <path d="M10 32h60" stroke="var(--color-text-muted)" stroke-width="2"/>
        <circle cx="24" cy="26" r="2" fill="var(--color-text-muted)"/>
        <circle cx="32" cy="26" r="2" fill="var(--color-text-muted)"/>
        <circle cx="40" cy="26" r="2" fill="var(--color-text-muted)"/>
        <path d="M28 44l6 6 12-12" stroke="var(--color-text-muted)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    @if ($title)
        <h3 style="font-family:var(--font-serif);font-style:italic;font-size:15px;color:var(--color-text-secondary);margin-bottom:6px;">{{ $title }}</h3>
    @endif
    @if ($subtitle)
        <p style="font-family:var(--font-sans);font-size:13px;color:var(--color-text-muted);margin:0;">{{ $subtitle }}</p>
    @endif
    @if ($slot)
        <div style="margin-top:16px;">{{ $slot }}</div>
    @endif
</div>
