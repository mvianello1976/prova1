@props(['label' => null])
<div class="relative {{ $label ? 'top-2' : '' }}">
    @isset($label)
        <span class="absolute top-0.5 {{ isset($icon) && $icon ? 'left-12' : 'left-4' }} text-xs text-627277">
        {{ $label }}
    </span>
    @endisset
    @isset($icon)
        <div
            class="absolute {{ $label ? 'top-2.5' : 'top-4' }} mt-0.5 left-4 z-10 ml-px flex items-center pointer-events-none text-ffbb7c">
            {{ $icon }}
        </div>
    @endisset
    <input
        x-ref="picker"
        {{ $attributes->merge(['class']) }}
        type="text"
        placeholder="{{ $title ?? '' }}"
        tabindex="-1"
        readonly
    >
</div>
