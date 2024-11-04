<div class="p-4">
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Annulla prenotazione') }}</h3>
    <div class="mt-8 space-y-6">
        <x-input wire:model.live="reason" type="text" label="{{ __('Motivazione') }}"></x-input>
        <div class="flex items-center justify-end mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="confirm" color="orange">
                    {{ __('Conferma') }}
                </x-tripsy-button>
            </div>
        </div>
    </div>
</div>
