<a {{ $attributes->merge(['class' => 'group flex items-center space-x-4 py-4 hover:cursor-pointer']) }}>
    {{ $icon }}
    <div class="flex-1 space-y-1">
        <h4 class="text-sm text-006cbc font-semibold">{{ $title }}</h4>
        <p class="text-xs text-627277 group-hover:text-0d171a">{{ $subtitle }}</p>
    </div>
    <x-heroicon-o-chevron-right class="w-5 h-5 text-0d171a shrink-0 group-hover:text-006cbc" />
</a>
