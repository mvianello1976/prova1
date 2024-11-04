<div>
    <h3 class="text-xl font-semibold text-0d171a hidden lg:block">{{ __('Sicurezza') }}</h3>
    <hr class="my-3 hidden lg:block">
    <div class="space-y-10">
        <div class="grid grid-cols-2 gap-5">
            <div class="col-span-2 md:col-span-1 space-y-3">
                <x-input wire:model="form.current_password" type="password" label="{{ __('Password attuale') }}"/>
                <x-input wire:model="form.password" type="password" label="{{ __('Nuova Password') }}"/>
                <x-input wire:model="form.password_confirmation" type="password" label="{{ __('Conferma password') }}"/>
                <x-tripsy-button
                    wire:click="update"
                    color="black">
                    {{ __('Aggiorna password') }}
                </x-tripsy-button>
            </div>
            <div class="col-span-2">
                <div class="rounded-md bg-yellow-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">{{ __('Attenzione') }}</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>
                                    {{ __('La modifica della password comporta il logout automatico dalla piattaforma.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-0d171a">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam corporis cumque cupiditate doloremque eius est, fugiat officia quae quasi reiciendis. Atque dicta dolor est iure omnis quaerat repudiandae voluptates voluptatibus.</p>
                <a href="#" class="text-xs text-006cbc underline font-semibold">{{ __('Impostazioni sulla privacy') }}</a>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-0d171a">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam corporis cumque cupiditate doloremque eius est, fugiat officia quae quasi reiciendis. Atque dicta dolor est iure omnis quaerat repudiandae voluptates voluptatibus.</p>
                <span wire:click="delete" wire:confirm class="text-xs text-ff7968 underline font-semibold">{{ __('Elimina l\'account') }}</span>
            </div>
        </div>
    </div>
</div>
