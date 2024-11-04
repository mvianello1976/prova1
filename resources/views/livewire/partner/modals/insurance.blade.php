<div class="p-4">
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Completa la registrazione') }}</h3>
    <div class="mt-8 space-y-6">
        <x-input type="text" wire:model="registration_number" label="{{ __('Numero registrazione') }}" required/>
        <div>
            <x-label class="mb-1">{{ __('Assicurazione Responsabilità Civile') }}</x-label>
            <livewire:dropzone
                wire:model="liability_insurance"
                :rules="['file','mimes:pdf','max:4096']"
            >
            </livewire:dropzone>
        </div>
        <div class="flex items-center justify-end mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="submit" color="orange">
                    {{ __('Salva') }}
                </x-tripsy-button>
            </div>
        </div>
    </div>
</div>
