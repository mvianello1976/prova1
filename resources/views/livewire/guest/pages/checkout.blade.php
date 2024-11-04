<div>
    <div class="bg-fafcfc py-10">
        <div class="container">
            @error('date_past')
            <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>
            @enderror
            <div class="flex justify-center mb-10">
                <nav class="relative w-full max-w-lg mx-auto">
                    <ol class="flex items-start">
                        @foreach($steps as $k => $step)
                            <li class="relative flex flex-col items-center justify-center text-center space-y-2 w-14">
                                <div
                                    class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 ring-2 ring-offset-1 ring-fafcfc {{ $currentStep >= $k ? 'border-ffbb7c bg-ffbb7c' : 'border-b0b7be bg-fafcfc' }}">
                                    <span
                                        class="text-xs font-semibold {{ $currentStep >= $k ? 'text-white' : 'text-b0b7be' }}">
                                        @if($currentStep <= $k)
                                            {{ $k }}
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m4.5 12.75 6 6 9-13.5"/>
                                        </svg>
                                        @endif
                                    </span>
                                </div>
                                <span
                                    class="text-xs font-semibold {{ $currentStep >= $k ? 'text-ffbb7c' : 'text-b0b7be' }}">
                                        {{ $step }}
                                </span>
                            </li>
                            @if(!$loop->last)
                                <div
                                    class="relative flex-1 h-0.5 w-full top-4 {{ $currentStep > $k ? 'bg-ffbb7c' : 'bg-b0b7be' }}"></div>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 xl:gap-32">
                <div class="col-span-1 space-y-4">
                    @if(auth()->user())
                        @switch($currentStep)
                            @case(1)
                                <h3 class="text-2xl font-semibold text-0d171a">{{ __('Verifica i tuoi dati personali') }}</h3>
                                <form class="space-y-6">
                                    <x-input type="text" wire:model="form.first_name" label="{{ __('Nome') }}" required/>
                                    <x-input type="text" wire:model="form.last_name" label="{{ __('Cognome') }}" required/>
                                    <x-input type="email" wire:model="form.email" label="{{ __('Email') }}" disabled readonly required/>
                                    <x-select wire:model="form.country_id" label="{{ __('Paese') }}">
                                        <option value="">{{ __('Seleziona') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input type="text" wire:model="form.mobile" label="{{ __('Cellulare') }}" required
                                             hint="{{ __('Ti ricontatteremo solo in caso di aggiornamenti importanti o modifiche alla tua prenotazione') }}"/>
                                    <x-tripsy-button type="button" wire:click="next"
                                                     color="blue">{{ __('Prosegui l\'acquisto') }}</x-tripsy-button>
                                </form>
                                @break
                            @case(2)
                                <h3 class="text-2xl font-semibold text-0d171a">{{ __('Seleziona un metodo di pagamento') }}</h3>
                                <x-tripsy-button wire:click="next"
                                                 color="blue">{{ __('Paga ora') }}</x-tripsy-button>
                                <x-tripsy-button wire:click="prev">{{ __('Indietro') }}</x-tripsy-button>
                                @break
                            @case(3)
                                <div class="space-y-6">
                                    <h3 class="text-2xl font-semibold text-0d171a">{{ __('Grazie del tuo acquisto') }}</h3>
                                    <p class="text-0d171a text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi ea earum incidunt libero minus obcaecati odio pariatur quasi? Adipisci at cum ea excepturi omnis optio quis sed temporibus ut vero.</p>
                                    <div class="w-full bg-white rounded-md shadow-md p-4">
                                        <h3 class="text-xl font-semibold text-0d171a mb-4">{{ __('Riepilogo dell\'ordine') }}</h3>
                                        <div class="py-4 divide-y divide-e2eaeb">
                                            @foreach($cart->items as $cart_item)
                                                <livewire:components.checkout.order-summary-item :item="$cart_item" wire:key="step3-{{$cart_item->id}}" :editCoupon="false"/>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <x-tripsy-button href="{{ route('guest.index') }}" color="black" class="hidden">{{ __('Torna alla Home') }}</x-tripsy-button>
                                @break
                        @endswitch
                    @else
                        <h3 class="text-2xl font-semibold text-0d171a">{{ __('Accedi o registrati') }}</h3>
                        <p class="text-sm text-627277">
                            Per continuare con il checkout,
                            <span wire:click="$dispatch('openModal', {component: 'common.modals.auth.login'})" class="text-ffa14a underline hover:cursor-pointer">accedi</span>
                            o
                            <span wire:click="$dispatch('openModal', {component: 'common.modals.auth.register'})" class="text-ffa14a underline hover:cursor-pointer">registrati</span>
                            alla piattaforma
                        </p>
                    @endif
                </div>
                <div class="col-span-1">
                    @switch($currentStep)
                        @case(3)
                            @if($cart->orders->count() > 0)
                                <div class="w-full bg-white rounded-md shadow-md p-4 divide-y divide-e2eaeb">
                                    <div class="space-y-5">
                                        <h3 class="text-xl font-semibold text-3ed1ca">{{ __('Ecco i tuoi biglietti') }}</h3>
                                        <div class="space-y-3">
                                            @foreach($cart->orders as $order)
                                                <div class="flex items-center justify-between border p-2 rounded-md">
                                                    <h5 class="text-sm font-medium">{{ $order->data['product']['name'] }}</h5>
                                                    @if(!$order->is_gift)
                                                        <x-tripsy-button href="{{ route('guest.tickets', ['order' => $order->uuid]) }}" target="_blank" color="fluoblue" class="space-x-2 !px-3.5 !py-1.5 !text-xs xl:!text-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                            </svg>
                                                            <span>{{ __('Scarica') }}</span>
                                                        </x-tripsy-button>
                                                    @else
                                                        <div
                                                            x-data
                                                            x-tooltip.raw="{{ __('Regalo a :name', ['name' => $order->gift_data['receiver_name']]) }}"
                                                            class="grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full hover:cursor-help">
                                                            <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <p class="text-sm text-0d171a">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ea in necessitatibus omnis qui quia, reprehenderit? Aliquam debitis itaque iure pariatur, possimus qui recusandae repellendus ut veniam vitae! Cum, facere?</p>
                                    </div>
                                </div>
                            @endif
                            @break
                        @default
                            <div class="w-full bg-white rounded-md shadow-md p-4 divide-y divide-e2eaeb">
                                <h3 class="text-xl font-semibold text-0d171a mb-4">{{ __('Riepilogo dell\'ordine') }}</h3>
                                <div class="py-4 divide-y divide-e2eaeb">
                                    @foreach($cart->items as $item)
                                        <livewire:components.checkout.order-summary-item :item="$item" wire:key="review-{{$item->id}}"/>
                                    @endforeach
                                </div>
                                <div class="py-4">
                                    <div x-data="{open: false}" class="space-y-4">
                                        <div
                                            x-on:click="open = !open"
                                            class="flex items-center space-x-2 text-sm text-00abc0 font-semibold hover:cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                            </svg>
                                            <span class="truncate underline">{{ __('Inserisci codice promozionale') }}</span>
                                        </div>
                                        <div x-cloak x-show="open" class="flex items-start space-x-3">
                                            <div class="flex-1">
                                                <x-input
                                                    wire:model="coupon_code"
                                                    type="text"
                                                    class="!h-10 text-center !rounded-full !border-e2eaeb font-mono uppercase placeholder:text-xs"
                                                    placeholder="{{ __('Inserisci codice promozionale') }}"/>
                                            </div>
                                            <x-tripsy-button wire:click="applyCoupon" color="blue">{{ __('Applica') }}</x-tripsy-button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col py-2">
                                    <div class="flex items-start justify-between text-xs">
                                        <h3>{{ __('Totale') }}</h3>
                                        <span class="block uppercase">
                                            {{ money($cart->total_price, forceDecimals: true) }}
                                        </span>
                                    </div>
                                    @if(auth()->user()->balance > 0)
                                        <div class="py-1" wire:key="user-balance">
                                            <div class="flex items-start justify-between text-xs text-4c9b5e">
                                                <span>{{ __('Saldo account') }}</span>
                                                @if(auth()->user()->hasSufficientBalance($cart->total_price))
                                                    <span>-{{ money($cart->total_price, forceDecimals: true) }}</span>
                                                @else
                                                    <span>-{{ money(auth()->user()->balance, forceDecimals: true) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center space-x-2 pb-10">
                                            <h3 class="text-xl font-semibold text-0d171a">{{ __('Totale Ordine') }}</h3>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-xl text-0d171a font-semibold uppercase">
                                                {{ money($cart->total_price_after_discount, forceDecimals: true) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</div>
