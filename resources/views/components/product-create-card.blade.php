@props(['item' => null, 'stepper' => true])

<div class="flex items-center justify-between">
    @isset($title)
        <h3 class="text-2xl text-0d171a font-semibold">{{ $title }}</h3>
    @endisset
    @if($stepper)
        <div class="flex items-center space-x-4">
            <div class="relative h-1.5 w-32 bg-gray-200 rounded-full overflow-hidden">
                <div class="absolute h-1.5 bg-fdac61"
                     style="width: {{ $item->steps_percentage }}%"></div>
            </div>
            <span class="text-xs text-1e2e33 whitespace-nowrap">
                {{ __(':step di 12', ['step' => $item->temporary_step ?? $item->current_step]) }}
            </span>
        </div>
    @endif
</div>
<div class="mt-8">
    <div wire:key="category" class="space-y-8">
        <div class="space-y-2">
            @isset($content_title)
                <h5 class="text-sm text-0d171a font-semibold">{{ $content_title }}</h5>
            @endisset
            @isset($content_subtitle)
                <p class="text-xs text-627277">{{ $content_subtitle }}</p>
            @endisset
        </div>
        <div class="space-y-5">
            {{ $slot }}
        </div>
    </div>
</div>
