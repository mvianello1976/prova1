<div>
    <div class="flex items-center justify-between">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Dati del pagamento') }}</h3>
        <x-slide-over size="md">
            <x-slot name="trigger">
                <span class="block font-medium text-006cbc leading-none mt-3 hover:underline hover:cursor-pointer">{{ __('Modifica') }}</span>
            </x-slot>
            <livewire:partner.pages.profile.modals.edit-payments-data/>
            <x-slot name="footer">
                <div class="flex items-center justify-end">
                    <div class="space-x-3">
                        <x-tripsy-button wire:click="$dispatch('submit-profile-data')" color="orange">
                            {{ __('Salva') }}
                        </x-tripsy-button>
                    </div>
                </div>
            </x-slot>
        </x-slide-over>
    </div>
    <div class="space-y-3 mt-6">
        <dl>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Nome Banca') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->bank_name)
                        {{ $informations->bank_name }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Titolare del conto') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->bank_account_holder)
                        {{ $informations->bank_account_holder }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('IBAN') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->bank_iban)
                        {{ $informations->bank_iban }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('BIC') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->bank_bic)
                        {{ $informations->bank_bic }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Paese') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->country_id)
                        {{ $informations->company_country->name }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
    <hr class="my-5">
    <h3 class="text-2xl text-0d171a font-semibold">{{ __('Dettagli tasse') }}</h3>
    <div class="space-y-3 mt-6">
        <dl>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Partita IVA') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->vat_number)
                        {{ $informations->vat_number }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Codice Fiscale') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->fiscal_code)
                        {{ $informations->fiscal_code }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
    <hr class="my-5">
    <h3 class="text-2xl text-0d171a font-semibold">{{ __('Impostazioni pagamenti') }}</h3>
    <div class="space-y-3 mt-6">
        <dl>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Frequenza dei pagamenti') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{--                                    @if($informations->vat_number)--}}
                    {{--                                        {{ $informations->vat_number }}--}}
                    {{--                                    @else--}}
                    {{--                                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>--}}
                    {{--                                    @endif--}}
                    ???
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('% di commissioni') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    ???
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Valuta') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->country_id)
                        {{ $informations->company_country->currency_name }}
                        @if($informations->company_country->currency_symbol)
                            ({{ $informations->company_country->currency_symbol }})
                        @endif
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
