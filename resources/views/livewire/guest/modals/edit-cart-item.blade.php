<div class="p-4">
    <h3 class="text-xl text-ffbb7c text-center font-semibold">{{ __('Modifica la tua prenotazione') }}</h3>
    <div class="mt-8">
        <div>
            <div class="divide-y">
                <div class="py-6 space-y-3">
                    <x-datepicker wire:model.live="form.date" autoclose>
                        <x-slot:title>
                            {{ __('Data') }}
                        </x-slot:title>
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                            </svg>
                        </x-slot:icon>
                    </x-datepicker>
                    @if($form->date)
                        <x-tripsy-select inline class="w-full" :disabled="count($form->time_list) <= 0">
                            <x-slot:title>
                                {{ $form->time_list[$form->time] ?? __('Orario') }}
                            </x-slot:title>
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </x-slot:icon>
                            <x-slot:content>
                                @foreach($form->time_list as $k => $t)
                                    <li wire:key="time-{{$k}}"
                                        wire:click="$set('form.time', {{$k}})"
                                        class="{{ $form->time == $k ? 'text-ffa14a' : '' }}"
                                    >
                                        {{ $t }}
                                    </li>
                                @endforeach
                            </x-slot:content>
                        </x-tripsy-select>
                    @endif
                </div>
                <div x-data="{open: false}" class="py-6">
                    @if($form->product->isRental() && $form->availability_date)
                        <span class="text-xs">
                            {{ __('N. max partecipanti: ') }} {{ $form->availability_date->participants_per_vehicle }}
                        </span>
                    @endif
                    <div x-on:click="open = !open" class="flex items-center justify-between">
                        <h5 class="text-sm font-semibold">{{ trans_choice('[*] Partecipanti x :count', $form->participants()) }}</h5>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0"
                             :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </div>
                    <div x-cloak x-show="open" class="space-y-2 mt-4">
                        <div>
                            <div class="flex items-start justify-between text-sm text-0d171a">
                                <div>
                                    <span>{{ __('Adulti') }}</span>
                                    <span
                                        class="block text-xs text-627277">{{ __('Età 17+ anni') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div wire:click="decrement('adults')"
                                         class="w-6 h-6 bg-white border border-e2eaeb rounded-full flex items-center justify-center hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             class="w-3 h-3 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M5 12h14"/>
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm text-1e2e33 min-w-4 text-center">{{ $form->adults }}</span>
                                    <div wire:click="increment('adults')"
                                         class="w-6 h-6 bg-white border border-e2eaeb rounded-full flex items-center justify-center hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             class="w-3 h-3 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start justify-between text-sm text-0d171a">
                                <div>
                                    <span>{{ __('Ragazzi') }}</span>
                                    <span
                                        class="block text-xs text-627277">{{ __('Età 8-16 anni') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div wire:click="decrement('kids')"
                                         class="w-6 h-6 bg-white border border-e2eaeb rounded-full flex items-center justify-center hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             class="w-3 h-3 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M5 12h14"/>
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm text-1e2e33 min-w-4 text-center">{{ $form->kids }}</span>
                                    <div wire:click="increment('kids')"
                                         class="w-6 h-6 bg-white border border-e2eaeb rounded-full flex items-center justify-center hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             class="w-3 h-3 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start justify-between text-sm text-0d171a">
                                <div>
                                    <span>{{ __('Bambini') }}</span>
                                    <span
                                        class="block text-xs text-627277">{{ __('Fino a 7 anni') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div wire:click="decrement('children')"
                                         class="w-6 h-6 bg-white border border-e2eaeb rounded-full flex items-center justify-center hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             class="w-3 h-3 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M5 12h14"/>
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm text-1e2e33 min-w-4 text-center">{{ $form->children }}</span>
                                    <div wire:click="increment('children')"
                                         class="w-6 h-6 bg-white border border-e2eaeb rounded-full flex items-center justify-center hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             class="w-3 h-3 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-start justify-between py-5 border-y border-e2eaeb">
            <p class="text-xl text-0d171a font-semibold">{{ __('Totale') }}</p>
            <p class="text-xl text-0d171a font-semibold">{{ money($form->total(), forceDecimals: true) }}</p>
        </div>
        @error('date_past')
        <div class="text-center mt-4 mx-3">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-ff7968">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
                <h3 class="text-1e2e33 font-semibold">{{ __('Errore') }}</h3>
            </div>
            <p class="text-xs text-627277">{{ $message }}</p>
        </div>
        @enderror
        @error('slots')
        <div class="text-center mt-4 mx-3">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-ff7968">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
                <h3 class="text-1e2e33 font-semibold">{{ __('Posti non disponibili') }}</h3>
            </div>
            <p class="text-xs text-627277">{{ $message }}</p>
        </div>
        @enderror
        <div class="flex items-center justify-center mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="$dispatch('closeModal')" color="gray">
                    {{ __('Annulla') }}
                </x-tripsy-button>
                <x-tripsy-button wire:click="checkAvailability" color="orange" :disabled="!$form->date || !$form->time || $form->participants() <= 0">
                    {{ __('Modifica') }}
                </x-tripsy-button>
            </div>
        </div>
    </div>
</div>
