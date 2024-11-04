@props(['value' => null])
@php
    $classes = 'flex items-center justify-center rounded-md py-3 px-3 text-sm font-medium border sm:flex-1 cursor-pointer focus:outline-none'
@endphp
@error($attributes->wire('model')->value())
    @php
        $classes .= ' border-red-500 text-red-500'
    @endphp
@enderror
<label
    {{ $attributes->merge(['class' => $classes]) }}
    >
    <input
        {{ $attributes->wire('model') }}
        type="radio"
        value="{{$value}}"
        name="{{ $attributes->wire('model')->value() }}"
        class="sr-only"
    >
    <span>{{ $slot }}</span>
</label>
