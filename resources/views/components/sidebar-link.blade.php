@props(['active' => false, 'href' => '#', 'icon' => ''])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'flex items-center gap-3 px-5 py-2.5 rounded-lg text-[13.5px] transition-colors']) }}
    style="color:{{ $active ? '#fff' : 'var(--color-sidebar-text)' }};background:{{ $active ? 'var(--color-sidebar-active)' : 'transparent' }};font-weight:{{ $active ? '500' : '400' }};"
    x-show="!sidebarCollapsed"
>
    @if ($icon)
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            {!! $icon !!}
        </svg>
    @endif
    {{ $slot }}
</a>
