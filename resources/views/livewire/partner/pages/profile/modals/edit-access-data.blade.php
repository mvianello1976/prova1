<div>
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Modifica i dati di accesso') }}</h3>
    <div class="mt-8 space-y-6">
        <x-input wire:model="email" type="email" label="{{ __('Email') }}" required/>
        <div class="!mt-10 space-y-4">
            <x-input wire:model="current_password" type="password" label="{{ __('Password attuale') }}"/>
            <x-input wire:model="password" type="password" label="{{ __('Nuova Password') }}"/>
            <x-input wire:model="password_confirmation" type="password" label="{{ __('Conferma password') }}"/>
        </div>
    </div>
</div>
