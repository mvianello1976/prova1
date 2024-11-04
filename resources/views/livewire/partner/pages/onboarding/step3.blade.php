<div class="max-w-2xl mx-auto border rounded bg-white p-8">
    <div class="space-y-6">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Grazie per la registrazione') }}</h3>
        <p class="text-sm text-1e2e33">
            {!! __('Prima di effettuare il login, controlla <strong>:email</strong> per confermare il tuo indirizzo email.', ['email' => auth()->user()->email]) !!}
        </p>
        <div class="text-center">
            immagine
        </div>
        <div>
            <p class="text-sm text-1e2e33 text-center">
                {{ __('Non hai ricevuto l\'email?') }}
                <span wire:click="$dispatch('sent')"
                      class="text-ffa14a font-semibold underline hover:cursor-pointer">{{ __('Clicca qui') }}</span>
            </p>
            <x-action-message on="sent" class="mt-8 text-center !text-259332">
                {{ __('Email inviata con successo') }}
            </x-action-message>
        </div>
    </div>
</div>
