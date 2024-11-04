@props(['color' => 'bg-ffbb7c', 'count' => null, 'activity' => null])
<div class="h-8 flex items-center space-x-2">
    <div class="grid place-items-center w-8 h-8 {{ $color }} rounded-full text-white shrink-0">
        {{ $icon }}
    </div>
    <span class="text-xs text-white font-medium truncate">{{ trans_choice(":count $activity", $count) }}</span>
</div>
