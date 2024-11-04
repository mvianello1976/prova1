@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block text-xs text-627277']) }}>
    {{ $value ?? $slot }} @if($required)<span>*</span>@endif
</label>
