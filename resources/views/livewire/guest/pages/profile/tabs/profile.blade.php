<div>
    <h3 class="text-xl font-semibold text-0d171a hidden lg:block">{{ __('Informazioni personali') }}</h3>
    <hr class="my-3 hidden lg:block">
    <div class="space-y-10">
        <div class="grid grid-cols-2 gap-5">
            <div class="col-span-2 md:col-span-1">
                <x-input wire:model="form.first_name" label="{{ __('Nome') }}"></x-input>
            </div>
            <div class="col-span-2 md:col-span-1">
                <x-input wire:model="form.last_name" label="{{ __('Cognome') }}"></x-input>
            </div>
            <div class="col-span-2 md:col-span-1">
                <x-input wire:model="form.email" type="email" label="{{ __('Email') }}" hint="{{ __('Attenzione: questa email è utilizzata per il login') }}"></x-input>
            </div>
            <div class="col-span-2 md:col-span-1">
                <x-input wire:model="form.mobile" type="tel" label="{{ __('Cellulare') }}"></x-input>
            </div>
            <div class="col-span-2 md:col-span-1">
                <x-input wire:model="form.date_of_birth" type="date" label="{{ __('Data di nascita') }}"></x-input>
            </div>
            <div class="col-span-2 grid grid-cols-2 gap-5">
                <div class="col-span-2 md:col-span-1">
                    <x-select wire:model="form.country_id" label="{{ __('Paese') }}">
                        <option value="">{{ __('Seleziona') }}</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <x-select wire:model="form.language" label="{{ __('Lingua') }}">
                        <option value="">{{ __('Seleziona') }}</option>
                        @foreach(config('tripsytour.languages') as $code => $language)
                            <option value="{{ $code }}">{{ $language }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
        <x-tripsy-button
            wire:click="update"
            color="black">
            {{ __('Salva') }}
        </x-tripsy-button>
    </div>
</div>
