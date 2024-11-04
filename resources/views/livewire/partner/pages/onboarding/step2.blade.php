<div class="max-w-2xl mx-auto border rounded bg-white p-8">
    <div class="flex items-center justify-between">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Unisciti a noi come partner') }}</h3>
        <span class="text-sm text-b0b7be font-semibold">{{ __('Step 2 di 3') }}</span>
    </div>
    <div class="mt-8 space-y-6">
        <x-input wire:model="form.company_name" type="text" label="{{ __('Nome Azienda') }}"
                 hint="{{ __('Il tuo nome o brand può essere modificato in seguito') }}"/>
        <x-input wire:model="form.business_name" type="text" label="{{ __('Ragione Sociale') }}" required/>
        <x-input wire:model="form.vat_number" type="text" label="{{ __('Partita IVA') }}" required/>
        <x-input wire:model="form.head_office_address" type="text" label="{{ __('Indirizzo Sede Legale') }}" required/>
        <x-input wire:model="form.pec" type="email" label="{{ __('PEC') }}" required/>
        <x-input wire:model="form.sdi" type="text" label="{{ __('SDI') }}"/>
        <x-input wire:model="form.company_link" type="text" label="{{ __('Sito web') }}"
                 hint="{{ __('Aggiungi il link del tuo sito web, TripAdvisor, Instagram o Facebook') }}"/>
        <div class="grid grid-cols-2 gap-4">
            <x-select wire:model="form.country_id" label="{{ __('In che paese è registata l\'azienda?') }}" required>
                <option value="">{{ __('Seleziona') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </x-select>
            <x-select wire:model="form.currency" label="{{ __('Valuta preferita per il pagamento?') }}" required>
                <option value="">{{ __('Seleziona') }}</option>
                <option value="eur">Euro</option>
            </x-select>
        </div>
        <hr>
        <div class="grid grid-cols-2 gap-4">
            <x-input wire:model="form.contact_first_name" type="text" label="{{ __('Nome Referente') }}"/>
            <x-input wire:model="form.contact_last_name" type="text" label="{{ __('Cognome Referente') }}"/>
        </div>
        <div>
            <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input wire:model.live="form.terms" id="terms" name="terms" type="checkbox"
                           value="1"
                           class="h-4 w-4 rounded border-e2eaeb text-03b8ce focus:ring-03b8ce">
                </div>
                <div class="ml-3 text-sm leading-6">
                    <label for="terms" class="font-medium text-1e2e33">
                        {{ __('Termini e condizioni') }} <a href="#"
                                                            class="text-ffa14a underline">{{ __('clicca qui') }}</a>
                    </label>
                </div>
            </div>
            @error('form.terms')
            <x-input-error for="form.terms"></x-input-error>
            @enderror
        </div>
        <div class="flex justify-end space-x-4">
            <x-tripsy-button wire:click="prev">{{ __('Indietro') }}</x-tripsy-button>
            <x-tripsy-button
                color="orange"
                wire:click="next"
                wire:loading.attr="disabled"
            >
                {{ __('Avanti') }}
            </x-tripsy-button>
        </div>
    </div>
</div>
