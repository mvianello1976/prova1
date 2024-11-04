<div class="p-4">
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Completa la registrazione') }}</h3>
    <div class="mt-8 space-y-6">
        <x-input type="text" wire:model="bank_name" label="{{ __('Nome Banca') }}" required/>
        <x-input type="text" wire:model="bank_account_holder" label="{{ __('Titolare del Conto') }}" required/>
        <x-input type="text" wire:model="bank_iban" label="{{ __('IBAN') }}" required/>
        <x-input type="text" wire:model="bank_bic" label="{{ __('BIC') }}" required/>
        <div class="flex items-center justify-end mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="submit" color="orange">
                    {{ __('Salva') }}
                </x-tripsy-button>
            </div>
        </div>
    </div>
</div>
