@props(['lines' => 3, 'height' => '14px', 'width' => '100%', 'lastWidth' => '60%'])

<div {{ $attributes->merge(['style' => 'display:flex;flex-direction:column;gap:10px;']) }}>
    @for ($i = 0; $i < $lines; $i++)
        <div class="skeleton" style="height:{{ $height }};width:{{ $i === $lines - 1 ? $lastWidth : $width }};"></div>
    @endfor
</div>
