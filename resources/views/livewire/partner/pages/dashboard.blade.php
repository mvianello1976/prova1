<div>
    <div class="max-w-5xl mx-auto space-y-8">
        @if(!$published)
            <div class="border rounded bg-white p-8">
                <div class="grid grid-cols-3 items-center">
                    <div class="col-span-2">
                        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Benvenuto :name', ['name' => auth()->user()->first_name]) }}</h3>
                        <p class="text-sm text-1e2e33 mt-8 mb-6 max-w-md">
                            {{ __('Crea il tuo primo prodotto e condividi esperienze indimenticabili con milioni di viaggiatori.') }}
                        </p>
                        <x-tripsy-button href="{{ route('product.init.create') }}" color="orange">
                            {{ __('Crea prodotto') }}
                        </x-tripsy-button>
                    </div>
                    <div class="col-span-1 text-center">
                        immagine
                    </div>
                </div>
            </div>
        @elseif($drafts->count())
            <div class="border rounded bg-white p-8">
                <div>
                    <h3 class="text-2xl text-0d171a font-semibold">{{ __('Completa la creazione dei tuoi prodotti') }}</h3>
                    @foreach($drafts as $draft)
                        <div class="border mt-8 rounded p-3 space-y-3">
                            <div class="flex items-center justify-between">
                                <h5 class="text-sm text-1e2e33 font-semibold max-w-md">
                                    {{ $draft->name ?: 'Prodotto' }}
                                </h5>
                                <a href="{{ route('product.create', $draft->id) }}" class="text-xs text-03b8ce font-semibold">{{ __('Riprendi') }}</a>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="relative h-2.5 w-96 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="absolute h-2.5 bg-00abc0"
                                         style="width: {{ $draft->draft_steps_percentage }}%"></div>
                                </div>
                                <span class="text-xs text-1e2e33 whitespace-nowrap">
                                    {{ round($draft->draft_steps_percentage) }}%
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(auth()->user()->partnerMissingData()['total'] < 100)
            <div class="border rounded bg-white p-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl text-0d171a font-semibold">{{ __('Completa la registrazione') }}</h3>
                    <div class="flex items-center space-x-4">
                        <div class="relative h-1.5 w-32 bg-gray-200 rounded-full overflow-hidden">
                            <div class="absolute h-1.5 bg-006cbc"
                                 style="width: {{auth()->user()->partnerMissingData()['total']}}%"></div>
                        </div>
                        <span class="text-xs text-1e2e33 whitespace-nowrap">
                        {{ __(':step di 4', ['step' => auth()->user()->partnerMissingData()['steps']]) }}
                    </span>
                    </div>
                </div>
                <div class="mt-8 divide-y divide-e2eaeb">
                    @if(auth()->user()->checkInsurance())
                        <x-missing-data-item wire:click="$dispatch('openModal', {component: 'partner.modals.insurance'})">
                            <x-slot:icon>
                                <x-heroicon-o-document-text class="w-5 h-5 text-0d171a shrink-0"/>
                            </x-slot:icon>
                            <x-slot:title>{{ __('Aggiungi numero di registrazione e assicurazione di responsabilità civile') }}</x-slot:title>
                            <x-slot:subtitle>{{ __('Risolvi le questioni legali importanti') }}</x-slot:subtitle>
                        </x-missing-data-item>
                    @endif
                    @if(auth()->user()->checkCompanyLogo())
                        <x-missing-data-item wire:click="$dispatch('openModal', {component: 'partner.modals.company-logo'})">
                            <x-slot:icon>
                                <x-heroicon-o-photo class="w-5 h-5 text-0d171a shrink-0"/>
                            </x-slot:icon>
                            <x-slot:title>{{ __('Aggiungi il logo dell\'azienda') }}</x-slot:title>
                            <x-slot:subtitle>{{ __('Fai sapere ai clienti che sei davvero tu con il tuo logo') }}</x-slot:subtitle>
                        </x-missing-data-item>
                    @endif
                    @if(auth()->user()->checkBankData())
                        <x-missing-data-item wire:click="$dispatch('openModal', {component: 'partner.modals.bank'})">
                            <x-slot:icon>
                                <x-heroicon-o-credit-card class="w-5 h-5 text-0d171a shrink-0"/>
                            </x-slot:icon>
                            <x-slot:title>{{ __('Aggiungi il metodo di pagamento e i dettagli delle tasse') }}</x-slot:title>
                            <x-slot:subtitle>{{ __('Imposta come e quando vuoi essere pagato') }}</x-slot:subtitle>
                        </x-missing-data-item>
                    @endif
                    @if(auth()->user()->check2FA())
                        <x-missing-data-item href="{{ route('partner.profile.show', ['#2fa']) }}">
                            <x-slot:icon>
                                <x-heroicon-o-lock-closed class="w-5 h-5 text-0d171a shrink-0"/>
                            </x-slot:icon>
                            <x-slot:title>{{ __('Aggiungi doppia verifica') }}</x-slot:title>
                            <x-slot:subtitle>{{ __('Rendi il tuo account più sicuro aggiungendo un ulteriore livello di protezione') }}</x-slot:subtitle>
                        </x-missing-data-item>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
