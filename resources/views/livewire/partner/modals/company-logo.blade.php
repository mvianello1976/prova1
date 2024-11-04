<div class="p-4">
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Completa la registrazione') }}</h3>
    <div class="mt-8 space-y-6">
        <div>
            <x-label class="mb-1">{{ __('Logo dell\'azienda') }}</x-label>
            <livewire:dropzone
                wire:model="company_logo"
                :rules="['image','mimes:png','max:4096']"
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
