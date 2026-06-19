@props(['number' => 0, 'label' => '', 'trend' => null, 'trendUp' => true])

<div class="card" style="padding:20px;">
    <div style="font-family:var(--font-serif);font-size:28px;font-weight:600;color:var(--color-text-primary);line-height:1.1;">
        {{ $number }}
    </div>
    <div style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-secondary);margin-top:4px;">
        {{ $label }}
    </div>
    @if ($trend)
        <div style="display:flex;align-items:center;gap:4px;margin-top:8px;font-family:var(--font-sans);font-size:12px;color:{{ $trendUp ? 'var(--color-success)' : 'var(--color-danger)' }};">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <polyline points="{{ $trendUp ? '18 15 12 9 6 15' : '6 9 12 15 18 9' }}"/>
            </svg>
            {{ $trend }}
        </div>
    @endif
</div>
