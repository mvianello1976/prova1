@props(['id' => \Illuminate\Support\Str::random(), 'value' => null, 'description' => null])
@php
    $classes = 'h-4 w-4 border-gray-300 text-03b8ce focus:ring-03b8ce'
@endphp
@error($attributes->wire('model')->value())
    @php
        $classes .= ' text-red-500'
    @endphp
@enderror
<div class="relative flex items-start">
    <div class="flex h-6 items-center">
        <input
            id="{{$id}}"
            {{ $attributes->wire('model') }}
            type="radio"
            value="{{$value}}"
            name="{{ $attributes->wire('model')->value() }}"
            class="{{ $classes }}">
    </div>
    <div class="ml-3 text-sm leading-6">
        <label for="{{ $id }}" class="font-medium text-gray-900">{{ $slot }}</label>
        @if($description)
            <p class="text-627277 text-xs">{{ $description }}</p>
        @endif
    </div>
</div>
