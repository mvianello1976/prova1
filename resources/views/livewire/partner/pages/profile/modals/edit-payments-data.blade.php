<div>
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Modifica i dati del pagamento') }}</h3>
    <div class="mt-8 space-y-6">
        <x-input wire:model="bank_name" type="text" label="{{ __('Nome Banca') }}" required/>
        <x-input wire:model="bank_account_holder" type="text" label="{{ __('Titolare del conto') }}" required/>
        <x-input wire:model="bank_iban" label="{{ __('IBAN') }}" required></x-input>
        <x-input wire:model="bank_bic" label="{{ __('BIC') }}" required/>
        <div class="grid grid-cols-2 gap-4">
            <x-select wire:model="country_id" label="{{ __('Paese') }}" required>
                <option value="">{{ __('Seleziona') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </x-select>
            <x-select wire:model="currency" label="{{ __('Valuta') }}" required>
                <option value="">{{ __('Seleziona') }}</option>
                <option value="eur">Euro</option>
            </x-select>
        </div>
        <x-input wire:model="vat_number" type="text" label="{{ __('Partita IVA') }}" required/>
        <div class="grid grid-cols-2 gap-4">
            <x-select wire:model="payment_frequencies" label="{{ __('Frequenza dei pagamenti') }}" required>
                <option value="">{{ __('Seleziona') }}</option>
                @foreach(config('tripsytour.partner.payment_frequencies') as $k => $label)
                    <option value="{{ $k }}">{{ __($label) }}</option>
                @endforeach
            </x-select>
            <x-select wire:model="commission_percentage" label="{{ __('% di commissioni') }}" required>
                <option value="">{{ __('Seleziona') }}</option>
                @foreach(config('tripsytour.partner.commission_percentages') as $k => $label)
                    <option value="{{ $k }}">{{ __($label) }}</option>
                @endforeach
            </x-select>
        </div>
    </div>
</div>
