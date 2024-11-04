<div>
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Modifica i dati del profilo') }}</h3>
    <div class="mt-8 space-y-6">
        <div wire:key="partner_type">
            <div class="space-y-3">
                <h5 class="text-sm text-0d171a font-semibold">{{ __('Come gestisci la tua attività?') }}</h5>
                <div class="flex space-x-4">
                    <div class="flex-1 space-y-4">
                        <x-radio-small-card
                            wire:model.live="partner_type"
                            :class="$partner_type === 'company' ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                            value="company"
                        >
                            <div class="flex items-center space-x-3 text-sm">
                                <x-heroicon-o-building-office class="w-5 h-5"/>
                                <span class="font-medium">{{ __('Come azienda') }}</span>
                            </div>
                        </x-radio-small-card>
                    </div>
                    <div class="flex-1 space-y-4">
                        <x-radio-small-card
                            wire:model.live="partner_type"
                            :class="$partner_type === 'individual' ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                            value="individual"
                        >
                            <div class="flex items-center space-x-3 text-sm">
                                <x-heroicon-o-user class="w-5 h-5"/>
                                <span class="font-medium">{{ __('Come individuo') }}</span>
                            </div>
                        </x-radio-small-card>
                    </div>
                </div>
            </div>
            @error('partner_type')
            <x-input-error :for="$partner_type">{{ $message }}</x-input-error>
            @enderror
        </div>
        <x-input wire:model="company_name" type="text" label="{{ __('Nome Azienda') }}"/>
        <x-input wire:model="business_name" type="text" label="{{ __('Ragione Sociale') }}" required/>
        <x-input wire:model="head_office_address" label="{{ __('Indirizzo Sede Legale') }}"></x-input>
        <x-input wire:model="pec" type="email" label="{{ __('PEC') }}" required/>
        <x-input wire:model="sdi" type="text" label="{{ __('SDI') }}"/>
        <x-input wire:model="company_link" type="text" label="{{ __('Sito web') }}"
                 hint="{{ __('Aggiungi il link del tuo sito web, TripAdvisor, Instagram o Facebook') }}"/>
        <div class="grid grid-cols-2 gap-4">
            <x-input wire:model="contact_first_name" type="text" label="{{ __('Nome Referente') }}"/>
            <x-input wire:model="contact_last_name" type="text" label="{{ __('Cognome Referente') }}"/>
        </div>
    </div>
</div>
