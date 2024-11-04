@props(['href' => '#', 'active' => false])
<a href="{{ $href }}" class="group flex flex-col items-center {{ $active ? 'text-fdac61' : 'text-0d171a hover:text-fdac61' }}">
    @isset($icon)
        {{ $icon }}
    @endisset
    <span class="text-xs font-medium">{{ $slot }}</span>
</a>
