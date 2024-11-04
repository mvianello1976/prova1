<div class="p-4">
    <h3 class="text-xl text-ffbb7c text-center font-semibold">{{ __('Modifica dettagli del regalo') }}</h3>
    <div class="mt-8">
        <div>
            <div class="divide-y">
                <div class="py-6 space-y-3">
                    <x-input wire:model="form.receiver_name" label="{{ __('Dedicato a') }}"/>
                    <x-input wire:model="form.receiver_email" label="{{ __('Email') }}"/>
                    <x-input wire:model="form.receiver_message" label="{{ __('Messaggio') }}"/>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="$dispatch('closeModal')" color="gray">
                    {{ __('Annulla') }}
                </x-tripsy-button>
                <x-tripsy-button wire:click="save" color="orange">
                    {{ __('Salva') }}
                </x-tripsy-button>
            </div>
        </div>
    </div>
</div>
