<dl>
    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Autenticazione a due fattori') }}</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <h3 class="text-lg font-medium text-gray-900">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        {{ __('Termina l\'abilitazione dell\'autenticazione a due fattori.') }}
                    @else
                        {{ __('È stata attivata l\'autenticazione a due fattori.') }}
                    @endif
                @else
                    {{ __('Non è stata attivata l\'autenticazione a due fattori.') }}
                @endif
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    {{ __('Quando l\'autenticazione a due fattori è abilitata, durante l\'autenticazione verrà richiesto un token sicuro e casuale. Il token può essere recuperato dall\'applicazione Google Authenticator del telefono.') }}
                </p>
            </div>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            @if ($showingConfirmation)
                                {{ __('Per terminare l\'abilitazione dell\'autenticazione a due fattori, scansionare il seguente codice QR utilizzando l\'applicazione Authenticator del telefono o inserire la chiave di configurazione e fornire il codice OTP generato.') }}
                            @else
                                {{ __('L\'autenticazione a due fattori è ora abilitata. Scansionare il seguente codice QR utilizzando l\'applicazione Authenticator del telefono o immettere la chiave di configurazione.') }}
                            @endif
                        </p>
                    </div>

                    <div class="mt-4 p-2 inline-block bg-white">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>

                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Chiave') }}: {{ decrypt($this->user->two_factor_secret) }}
                        </p>
                    </div>

                    @if ($showingConfirmation)
                        <div class="mt-4">
                            <x-label for="code" value="{{ __('Codice') }}"/>

                            <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                                     wire:model="code"
                                     wire:keydown.enter="confirmTwoFactorAuthentication"/>

                            <x-input-error for="code" class="mt-2"/>
                        </div>
                    @endif
                @endif

                @if ($showingRecoveryCodes)
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Conservate questi codici di recupero in un gestore di password sicuro. Possono essere utilizzati per recuperare l\'accesso al proprio account in caso di smarrimento del dispositivo di autenticazione a due fattori.') }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
            @endif

            <div class="mt-5">
                @if (! $this->enabled)
                    <x-confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-tripsy-button color="orange" type="button" wire:loading.attr="disabled">
                            {{ __('Abilita') }}
                        </x-tripsy-button>
                    </x-confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-confirms-password wire:then="regenerateRecoveryCodes">
                            <x-tripsy-button color="gray" class="me-3">
                                {{ __('Rigenera i codici di recupero') }}
                            </x-tripsy-button>
                        </x-confirms-password>
                    @elseif ($showingConfirmation)
                        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-tripsy-button color="orange" type="button" class="me-3" wire:loading.attr="disabled">
                                {{ __('Conferma') }}
                            </x-tripsy-button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="showRecoveryCodes">
                            <x-tripsy-button color="gray" class="me-3">
                                {{ __('Visualizza i codici di recupero') }}
                            </x-tripsy-button>
                        </x-confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-tripsy-button color="gray" wire:loading.attr="disabled">
                                {{ __('Cancella') }}
                            </x-tripsy-button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-tripsy-button color="red" wire:loading.attr="disabled">
                                {{ __('Disabilita') }}
                            </x-tripsy-button>
                        </x-confirms-password>
                    @endif

                @endif
            </div>
        </dd>
    </div>
</dl>
