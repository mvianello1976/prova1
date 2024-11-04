@props(['label' => null, 'inline' => false, 'range' => false, 'autoclose' => false, 'timepicker' => false, 'disabledDates' => []])
@php
    $classes = 'relative min-h-14 mx-auto w-full bg-white ring-1 ring-e2eaeb rounded flex divide-y';
@endphp
<div
    {{ $attributes->merge(['class' => $classes]) }}
>
    <input
        x-data="{
            value: @entangle($attributes->wire('model')),
            }"
        x-ref="picker"
        x-bind:value="value"
        type="time"
        class="relative min-h-14 mx-auto w-full text-sm bg-inherit border-none rounded-[30px] flex flex-col justify-center divide-y px-4 placeholder:placeholder-e2eaeb focus:ring-0"
    >
</div>
