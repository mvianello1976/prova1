@props(['label' => null, 'inline' => false, 'range' => false, 'autoclose' => false, 'timepicker' => false, 'disabledDates' => []])
@php
    $classes = 'relative min-h-14 mx-auto w-full bg-white ring-1 ring-e2eaeb rounded flex divide-y';
@endphp
<div
    wire:ignore
    x-data="{
        value: @entangle($attributes->wire('model')),
        open: false,
        disabledDates: @js($disabledDates),
        init() {
            let picker = new airdatepicker(this.$refs.picker, {
                locale: localeIT,
                navTitles: {
                    days: 'MMMM yyyy'
                },
                dateFormat: 'dd/MM/yyyy',
                timeFormat: 'HH:mm',
                timepicker: @json($timepicker),
                onlyTimepicker: @json($timepicker),
                inline: @json($inline),
                range: @json($range),
                toggleSelected: false,
                autoClose: @json($autoclose),
                multipleDatesSeparator: ' - ',
                position: 'bottom center',
                selectedDates: $data.value ?? [],
                onSelect: function(date, formattedDate, datepicker) {
                    if(date.datepicker.opts.range === true) {
                        if(date.date.length === 2) {
                            $data.open = false
                            $data.value = date.formattedDate
                            date.datepicker.opts.selectedDates = $data.value
                        }
                    } else {
                        if(date.date === undefined) {
                            $data.open = false
                            $data.value = null
                            date.datepicker.opts.selectedDates = $data.value
                        } else {
                            $data.open = false
                            $data.value = date.formattedDate
                            date.datepicker.opts.selectedDates = $data.value
                        }
                    }
                }
            })

            picker.disableDate($data.disabledDates)
        }
    }"
    class="w-full mx-auto"
>
    <div x-on:click="open = true">
        <div {{ $attributes->merge(['class' => $classes]) }} :class="open && @json($inline) ? 'pb-5' : ''">
            <div :class="open ? 'h-auto' : 'h-14 overflow-hidden'" class="flex-1">
                <x-datepicker-input x-ref="picker" :label="$label"
                                    class="{{ isset($icon) ? 'pl-12' : '' }} relative min-h-14 mx-auto w-full text-sm bg-inherit border-none rounded-[30px] flex flex-col justify-center divide-y px-4 placeholder:placeholder-e2eaeb focus:ring-0">
                    @isset($title)
                        <x-slot:title>
                            {{ $title }}
                        </x-slot:title>
                    @endisset
                    @isset($icon)
                        <x-slot:icon>
                            {{ $icon }}
                        </x-slot:icon>
                    @endisset
                </x-datepicker-input>
            </div>
        </div>
        @error($attributes->wire('model')->value())
        <x-input-error for="{{$attributes->wire('model')}}"></x-input-error>
        @enderror
    </div>
</div>
