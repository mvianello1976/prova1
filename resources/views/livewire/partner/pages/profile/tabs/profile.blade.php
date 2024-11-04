<div>
    <div class="flex items-center justify-between">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Dati del profilo') }}</h3>
        <x-slide-over size="md">
            <x-slot name="trigger">
                <span class="block font-medium text-006cbc leading-none mt-3 hover:underline hover:cursor-pointer">{{ __('Modifica') }}</span>
            </x-slot>
            <livewire:partner.pages.profile.modals.edit-profile-data/>
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
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Profilo') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('tripsytour.partner.onboarding.partner_type.'. $informations->partner_type) }}
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Nome Azienda') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->company_name)
                        {{ $informations->company_name }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Indirizzo Sede Legale') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->head_office_address)
                        {{ $informations->head_office_address }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('PEC') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->pec)
                        {{ $informations->pec }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('SDI') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->sdi)
                        {{ $informations->sdi }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Link del sito') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->company_link)
                        {{ $informations->company_link }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Referente') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->contact_first_name && $informations->contact_last_name)
                        {{ $informations->contact_first_name }} {{ $informations->contact_last_name }}
                    @else
                        <span class="font-medium text-e57868">{{ __('Non specificato') }}</span>
                    @endif
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Logo aziendale') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @if($informations->company_logo)
                        <img src="{{ Storage::url($informations->company_logo) }}" class="h-16">
                        <div>
                            <span wire:click="$dispatch('openModal', {component: 'partner.modals.company-logo'})" class="block font-medium text-006cbc leading-none mt-3 hover:underline hover:cursor-pointer">{{ __('Sostituisci file') }}</span>
                            <span class="text-xs leading-none">{{ __('Max file size: 4MB') }}</span>
                        </div>
                    @else
                        <span class="font-medium text-e57868">
                                            {{ __('Non specificato') }}
                                        </span>
                        <div>
                            <span wire:click="$dispatch('openModal', {component: 'partner.modals.company-logo'})" class="block font-medium text-006cbc leading-none mt-3 hover:underline hover:cursor-pointer">{{ __('Carica file') }}</span>
                            <span class="text-xs leading-none">{{ __('Max file size: 4MB') }}</span>
                        </div>
                    @endif
                </dd>
            </div>
        </dl>
        <hr class="my-5">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Dati di accesso') }}</h3>
            <x-slide-over size="md">
                <x-slot name="trigger">
                    <span class="block font-medium text-006cbc leading-none mt-3 hover:underline hover:cursor-pointer">{{ __('Modifica') }}</span>
                </x-slot>
                <livewire:partner.pages.profile.modals.edit-access-data/>
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
                    <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Email') }}</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ auth()->user()->email }}
                    </dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Password') }}</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <span>************</span>
                    </dd>
                </div>
            </dl>
        </div>
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <hr class="my-5">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Doppia verifica') }}</h3>
            <div class="space-y-3 mt-6" id="2fa">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif
    </div>
</div>
