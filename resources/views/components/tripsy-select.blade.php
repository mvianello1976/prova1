@props(['title', 'icon', 'prepend', 'inline' => false, 'label' => null, 'disabled' => false])
@php
    $classes = 'relative min-h-14 mx-auto w-full bg-white border border-e2eaeb rounded-[30px] flex flex-col justify-center px-4';
    $classes .= !$inline ? ' overflow-hidden divide-y' : '';

    if($disabled) {
        $classes .= ' !opacity-25 !cursor-not-allowed !pointer-events-none';
    }
@endphp
<div x-data="{open: false}" x-on:click.outside="open = false" class="w-full">
    <div x-on:click="open = !open"
            {{ $attributes->merge(['class' => $classes]) }}>
        <div class="flex items-center h-14 space-x-2.5">
            @isset($icon)
                <div class="text-ffbb7c">
                    {{ $icon }}
                </div>
            @endisset
            <div class="flex flex-col text-left">
                <span class="text-xs text-627277">
                    {{ $label }}
                </span>
                <span class="text-sm text-0d171a">
                    {{ $title }}
                </span>
            </div>
            <div class="absolute right-4">
                @isset($prepend)
                    {{ $prepend }}
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-3.5 h-3.5 text-0d171a" :class="open ? 'rotate-180' : ''">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                    </svg>
                @endisset
            </div>
        </div>
        <div x-cloak x-show="open"
             class="{{ $inline ? 'absolute top-full left-0 translate-y-1.5 z-[11] w-full ring-1 ring-e2eaeb bg-white rounded-md px-4 shadow-xl' : '' }} py-2.5 text-left max-h-60 overflow-y-scroll">
            <ul class="text-sm space-y-4 hover:*:text-ffa14a hover:*:cursor-pointer">
                {{ $content }}
            </ul>
        </div>
    </div>
</div>
