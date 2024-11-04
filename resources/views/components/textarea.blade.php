@props(['max' => null, 'rows' => 5, 'disabled' => false, 'required' => false, 'name' => null, 'label' => false, 'hint' => false, 'append' => false, 'prepend' => false, 'iconColor' => 'text-gray-800'])
@php
    $n = $attributes->wire('model')->value() ?: $name;
    $slug = $attributes->wire('model')->value() ?: $n;
    $inputClass = 'block w-full text-sm text-0d171a border border-e2eaeb rounded focus:outline-none focus:ring-0 focus:ring-offset-0 placeholder:placeholder-e2eaeb disabled:opacity-50 disabled:cursor-not-allowed';
@endphp
@error($slug)
@php
    $inputClass .= ' pr-11 border-red-300 focus:outline-none text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500';
@endphp
@else
    @php
        $inputClass .= ' focus:border-indigo-300 focus:ring-indigo-200';
    @endphp
    @enderror
    @if($prepend)
        @php
            $inputClass .= ' pl-11';
        @endphp
    @endif
    @if($append)
        @php
            $inputClass .= ' pr-11';
        @endphp
    @endif

    <div
        x-data="{ count: 0 }"
        x-init="count = $refs.countable.value.length"
    >
        @if($label || isset($action))
            <div class="flex items-center justify-between">
                @if ($label)
                    <x-label :for="$name" :required="$required">{{ $label }}</x-label>
                @endif
                @isset($action)
                    <div class="text-xs">
                        {{ $action }}
                    </div>
                @endisset
            </div>
        @endif
        <div class="relative @if($label || isset($action)) mt-1 @endif">
            @if($prepend)
                {{ $prepend }}
            @endif
            <textarea
                x-ref="countable"
                x-on:keyup="count = $refs.countable.value.length"
                {{ $attributes->merge(['class' => $inputClass]) }}
                {{ $disabled ? 'disabled' : '' }}
                name="{{ $slug }}"
                id="{{ $slug }}"
                {{ $required ? 'required' : '' }}
                maxlength="{{ $max }}"
                rows="{{ $rows }}"
            ></textarea>
            @error($slug)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <x-icon
                    name="heroicon-o-exclamation-circle"
                    class="w-5 h-5 text-red-500"
                ></x-icon>
            </div>
            @else
                @if($append)
                    {{ $append }}
                @endif
                @enderror
        </div>
        @if($hint)
            @if($hint === 'counter')
                <p class="mt-1 text-xs text-627277">
                    <span x-html="count"></span> / <span x-html="$refs.countable.maxLength"></span>
                </p>
            @else
                <p class="mt-1 text-xs text-627277">{{ $hint }}</p>
            @endif
        @endif
        @error($slug)
        <x-input-error :for="$slug"/>
        @enderror
    </div>
