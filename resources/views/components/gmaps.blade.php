@props(['value' => null, 'disabled' => false, 'required' => false, 'name' => null, 'label' => false, 'hint' => false, 'append' => false, 'prepend' => false, 'iconColor' => 'text-gray-800', 'types' => []])
@php
    $n = $attributes->wire('model')->value() ?: $name;
    $slug = $attributes->wire('model')->value() ?: $n;
    $inputClass = 'h-14 block w-full text-sm text-0d171a border border-e2eaeb rounded focus:outline-none focus:ring-0 focus:ring-offset-0 placeholder:placeholder-e2eaeb disabled:opacity-50 disabled:cursor-not-allowed';
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
        x-data="{
        address: {
            city: '',
            province: '',
            country: '',
            lat: '',
            lng: '',
        },
        init() {
            this.element = this.$refs.googleAutocomplete;
            if (this.element === null) {
                console.error('Cannot find Google Places Autocomplete input [x-ref=\'googleAutocomplete\']');
                return;
            }
            if (typeof window.google === 'undefined') {
                location.reload()
                document.addEventListener('google:init', () => {
                    this.initAutocomplete();
                });
            } else {
                this.initAutocomplete();
            }
        },
        resetData() {
            this.address = {
                city: '',
                province: '',
                country: '',
                lat: '',
                lng: '',
            };
        },
        initAutocomplete() {
            this.autocomplete = new window.google.maps.places.Autocomplete(this.element, {
                types: @js($types),
                componentRestrictions: {
                    country: ['it']
                }
            });
            window.google.maps.event.addListener(this.autocomplete, 'place_changed', () => this.handleResponse(this.autocomplete.getPlace()));
        },
        handleResponse(placeResultData) {
            this.fullResultData = placeResultData;
            this.resetData();
            this.address.city = this.fullResultData.name;
            this.address.province = this.fullResultData.address_components[2].short_name;
            this.address.country = this.fullResultData.address_components[4].short_name;
            this.address.lat = this.fullResultData.geometry.location.lat();
            this.address.lng = this.fullResultData.geometry.location.lng();
            this.$dispatch('place-chosen', {types: @js($types), address: this.address, resultResponse: this.fullResultData});
        },
    }">
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
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    {{ $prepend }}
                </div>
            @endif
            <input
                x-ref="googleAutocomplete"
                {{ $attributes->merge(['class' => $inputClass]) }}
                {{ $attributes['type'] == 'number' && !$attributes['step'] ? 'step=0.001' : 'step=$attributes[\'step\']' }}
                {{ $disabled ? 'disabled' : '' }}
                name="{{ $slug }}"
                id="{{ $slug }}"
                {{ $required ? 'required' : '' }}
                value="{{ $value }}"
            >
            @error($slug)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <x-icon
                    name="heroicon-o-exclamation-circle"
                    class="w-5 h-5 text-red-500"
                ></x-icon>
            </div>
            @else
                @if($append)
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        {{ $append }}
                    </div>
                @endif
                @enderror
        </div>
        @if($hint)
            <p class="mt-1 text-xs text-627277">{{ $hint }}</p>
        @endif
        @error($slug)
        <x-input-error :for="$slug"/>
        @enderror
    </div>

    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places&callback=Function.prototype&loading=async"></script>
    <script>
        function googleReady() {
            document.dispatchEvent(new Event('google:init'));
        }
    </script>
