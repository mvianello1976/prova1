<div>
    <div class="container">
        @if(session()->has('added-to-cart'))
            @php
                $cart_item = session()->get('added-to-cart')
            @endphp
            <div x-data="{open: true}" x-show="open"
                 class="relative mt-5 py-8 px-6 rounded-md bg-e8faed ring-1 ring-b5eac4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative h-28 w-auto aspect-video rounded-md overflow-hidden">
                            <img src="{{ Storage::url($product->mainImage->path) }}"
                                 class="absolute w-full h-full inset-0 object-cover"
                                 alt="">
                        </div>
                        <div class="space-y-2">
                            <h5 class="flex items-center space-x-1 text-xs text-1e2e33 font-semibold uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                </svg>
                                <span class="truncate">{{ $cart_item->product->destination->name }}</span>
                            </h5>
                            <h3 class="text-sm font-semibold text-0d171a">{{ $cart_item->product->name }}</h3>
                            <p class="text-sm text-0d171a">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $cart_item->time->date)->translatedFormat('d F Y') }}
                                • {{ \Carbon\Carbon::createFromFormat('H:i:s', $cart_item->time->time)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-8 h-8 text-4c9b5e">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <span class="text-xl text-1e2e33 font-semibold">{{ __('Aggiunto al carrello') }}</span>
                        </div>
                        <x-tripsy-button href="{{ route('guest.cart') }}" color="blue"
                                         class="self-end">{{ __('Vai al carrello') }}</x-tripsy-button>
                    </div>
                </div>
                <div x-on:click="open = false" class="absolute top-2 right-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 text-627277">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
        @endif
        <nav class="flex py-10">
            <ol role="list" class="flex items-center space-x-4">
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('guest.index') }}"
                           class="text-xs font-medium text-627277 hover:text-gray-700">{{ env('APP_NAME') }}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="h-4 w-4 flex-shrink-0 text-b0b7be" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('guest.search', ['destination' => $destination->slug]) }}"
                           class="ml-4 text-xs font-medium text-627277 hover:text-gray-700">{{ $destination->name }}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="h-4 w-4 flex-shrink-0 text-b0b7be" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-4 text-xs font-medium text-627277"
                              aria-current="page">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="space-y-3">
            <h1 class="text-2xl font-bold text-1e2e33">{{ $product->name }}</h1>
            <div class="flex items-center justify-between">
                <h5 class="flex items-center space-x-1 text-xs text-00abc0 font-semibold uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                    <span class="truncate">{{ $destination->name }}</span>
                </h5>
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-1 text-0d171a text-sm font-medium hover:cursor-pointer">
                        <x-heroicon-o-share class="w-4 h-4 shrink-0"/>
                        <span>{{ __('Condividi') }}</span>
                    </div>
                    @auth
                        <div wire:click.prevent="toggleFavorite" class="flex items-center space-x-1 text-0d171a text-sm font-medium hover:cursor-pointer">
                            <div
                                class="flex items-center space-x-1 text-0d171a text-sm font-medium">
                                <x-heroicon-o-heart class="w-4 h-4 {{ $isFavorited ? 'fill-red-500 stroke-red-500' : 'group-hover/favorite:stroke-red-500' }}"/>
                                @if(!$isFavorited)
                                    <span>{{ __('Aggiungi ai preferiti') }}</span>
                                @else
                                    <span>{{ __('Aggiunto ai preferiti') }}</span>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="grid grid-cols-10 gap-2">
                <div class="relative col-span-6 h-auto rounded-md overflow-hidden">
                    <img src="{{ Storage::url($product->mainImage->path) }}"
                         class="absolute w-full h-full inset-0 object-cover" alt="">
                </div>
                <div class="grid grid-cols-2 col-span-4 gap-2">
                    @foreach($product->secondaryImages->take(4) as $secondary_image)
                        <div class="relative col-span-1 aspect-square rounded-md overflow-hidden">
                            <img src="{{ Storage::url($secondary_image?->path) }}"
                                 class="absolute w-full h-full inset-0 object-cover" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-12 gap-8 py-5">
                <div class="col-span-full lg:col-span-9">
                    <div class="flex items-center space-x-1 text-ffa14a text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="none" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                        </svg>
                        <span class="font-semibold">{{ round($product->reviews->avg('rating'), 1) }}</span>
                        <span class="text-1e2e33">({{ trans_choice(':count Recensione|[2,*] :count recensioni', $product->reviews->count()) }})</span>
                    </div>
                    <p class="my-5 text-0d171a text-sm">
                        {{ $product->description }}
                    </p>
                    <div class="space-y-6">
                        <h3 class="text-2xl text-00abc0 font-semibold">{{ __('Informazioni sull\'attività') }}</h3>
                        <div class="ml-4 flex items-start space-x-4">
                            <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span class="text-sm text-0d171a font-medium leading-tight">
                                    {{ __('Cancellazione') }}
                                </span>
                                <span class="text-sm text-627277">
                                    {{ config("tripsytour.cancellations.{$product->cancellation}.label") }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4 flex items-start space-x-4">
                            <x-heroicon-o-clock class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span class="text-sm text-0d171a font-medium leading-tight">
                                    {{ __('Durata') }}
                                </span>
                                <span class="text-sm text-627277">
                                    {{ trans_choice('{1} :count ora|[2,*] :count ore', $product->duration) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4 flex items-start space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                            </svg>
                            <div class="flex flex-col">
                                <span class="text-sm text-0d171a font-medium leading-tight">
                                    {{ __('Difficoltà') }}
                                </span>
                                <span class="text-sm text-627277">
                                    {{ config("tripsytour.difficulties.{$product->difficulty}") }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4 flex items-start space-x-4">
                            <x-heroicon-o-users class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span
                                    class="text-sm text-0d171a font-medium leading-tight">{{ __('Partecipanti') }}</span>
                                <span class="text-sm text-627277">Lorem ipsum dolor sit amet, consectetur adipisicing elit, adipisci aperiam architecto cum debitis dicta.</span>
                            </div>
                        </div>
                        <div class="ml-4 flex items-start space-x-4">
                            <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span class="text-sm text-0d171a font-medium leading-tight">
                                    {{ __('Accessibile in sedia a rotelle') }}
                                </span>
                                <span class="text-sm text-627277">
                                    {{ $product->accessibility ? __('Accessibile a persone con disabilità') : __('Non accessibile a persone con disabilità') }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4 flex items-start space-x-4">
                            <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span class="text-sm text-0d171a font-medium leading-tight">
                                    {{ __('Animali ammessi') }}
                                </span>
                                <span class="text-sm text-627277">
                                    {{ $product->pets_allowed ? __('Animali ammessi') : __('Animali non ammessi') }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4 flex items-start space-x-4">
                            <x-heroicon-o-user-group class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span
                                    class="text-sm text-0d171a font-medium leading-tight">{{ __('Personale d\'accoglienza') }}</span>
                                <span class="text-sm text-627277">
                                    {{ $product->reception_staff_languages }}
                                </span>
                            </div>
                        </div>
                        <h3 class="text-2xl text-00abc0 font-semibold">{{ __('Descrizione breve') }}</h3>
                        <p class="ml-4 text-0d171a text-sm">{{ $product->description }}</p>
                    </div>
                </div>
                <div class="hidden col-span-3 lg:block">
                    <div class="bg-fafcfc border border-e2eaeb rounded">
                        <div class="flex divide-x py-2">
                            <div wire:click="$set('currentTab', 'book')" class="flex-1 py-1 hover:cursor-pointer">
                                <div class="flex items-center justify-center space-x-3 flex-1 text-center">
                                    <div
                                        class="w-3 h-3 rounded-full ring-[2px] ring-offset-2 {{ $currentTab === 'book' ? 'bg-00abc0 ring-00abc0 font-semibold' : 'bg-transparent ring-b0b7be' }}"></div>
                                    <span class="text-sm text-0d171a {{ $currentTab === 'book' ? 'font-semibold' : '' }}">{{ __('Prenota') }}</span>
                                </div>
                            </div>
                            <div wire:click="$set('currentTab', 'gift')" class="flex-1 py-1 hover:cursor-pointer">
                                <div class="flex items-center justify-center space-x-3 flex-1 text-center">
                                    <div
                                        class="w-3 h-3 rounded-full ring-[2px] ring-offset-2 {{ $currentTab === 'gift' ? 'bg-00abc0 ring-00abc0 font-semibold' : 'bg-transparent ring-b0b7be' }}"></div>
                                    <span class="text-sm text-0d171a {{ $currentTab === 'gift' ? 'font-semibold' : '' }}">{{ __('Regala') }}</span>
                                </div>
                            </div>
                        </div>
                        @if($currentTab === 'book')
                            <div class="border-y p-4 pb-0">
                                <div class="divide-y">
                                    @if($product->isInSpecialOffer($date))
                                        <div
                                            class="grid place-items-center py-1.5 px-4 ring-1 ring-inset ring-blue-700/10 bg-blue-50 text-xs text-blue-700 font-semibold uppercase rounded-full">
                                            {{ __('In Offerta') }}
                                        </div>
                                    @endif
                                    <div class="pb-4 space-y-3 !border-t-0">
                                        <x-datepicker wire:model.live="date" autoclose>
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
                                        @if($date)
                                            <x-tripsy-select inline class="w-full" :disabled="count($time_list) <= 0">
                                                <x-slot:title>
                                                    {{ $time_list[$time] ?? __('Orario') }}
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
                                                    @foreach($time_list as $k => $t)
                                                        <li wire:key="time-{{$k}}"
                                                            wire:click="$set('time', {{$k}})"
                                                            class="{{ $time == $k ? 'text-ffa14a' : '' }}"
                                                        >
                                                            {{ $t }}
                                                        </li>
                                                    @endforeach
                                                </x-slot:content>
                                            </x-tripsy-select>
                                        @endif
                                    </div>
                                    <div x-data="{open: false}" class="py-6">
                                        @if($product->isRental() && $this->availability_date)
                                            <span class="text-xs">
                                            {{ __('N. max partecipanti: ') }} {{ $this->availability_date->participants_per_vehicle }}
                                        </span>
                                        @endif
                                        <div x-on:click="open = !open" class="flex items-center justify-between">
                                            <h5 class="text-sm font-semibold">{{ trans_choice('[*] Partecipanti x :count', $this->participants) }}</h5>
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
                                                            class="text-sm text-1e2e33 min-w-4 text-center">{{ $adults }}</span>
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
                                                            class="text-sm text-1e2e33 min-w-4 text-center">{{ $kids }}</span>
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
                                                            class="text-sm text-1e2e33 min-w-4 text-center">{{ $children }}</span>
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
                                    {{--                                @if($this->participants && $time)--}}
                                    <div class="flex items-center justify-between text-sm text-0d171a py-6">
                                        <span>{{ __('Totale') }}</span>
                                        <span class="font-semibold">{{ money($this->total, forceDecimals: true) }}</span>
                                    </div>
                                    {{--                                @endif--}}
                                </div>
                            </div>
                        @elseif($currentTab === 'gift')
                            <div class="border-y p-4 pb-0">
                                <div class="divide-y">
                                    <div class="pb-4 space-y-3 !border-t-0">
                                        <div class="relative min-h-14 mx-auto w-full bg-white ring-1 ring-e2eaeb rounded-[28px] flex divide-y">
                                            <div class="relative pl-12 min-h-14 mx-auto w-full text-sm bg-inherit border-none rounded-[30px] flex flex-col justify-center px-4 placeholder:text-0d171a focus:ring-0">
                                                <div class="absolute mt-0.5 left-4 z-10 ml-px flex items-center pointer-events-none text-ffbb7c">
                                                    <x-heroicon-o-gift class="w-5 h-5"/>
                                                </div>
                                                <span class="font-semibold">{{ __('Voucher regalo valido 12 mesi') }}</span>
                                            </div>
                                        </div>
                                        <x-datepicker wire:model.live="date" autoclose>
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
                                        @if($date)
                                            <x-tripsy-select inline class="w-full" :disabled="count($time_list) <= 0">
                                                <x-slot:title>
                                                    {{ $time_list[$time] ?? __('Orario') }}
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
                                                    @foreach($time_list as $k => $t)
                                                        <li wire:key="time-{{$k}}"
                                                            wire:click="$set('time', {{$k}})"
                                                            class="{{ $time == $k ? 'text-ffa14a' : '' }}"
                                                        >
                                                            {{ $t }}
                                                        </li>
                                                    @endforeach
                                                </x-slot:content>
                                            </x-tripsy-select>
                                        @endif
                                    </div>
                                    <div x-data="{open: false}" class="py-6">
                                        @if($product->isRental() && $this->availability_date)
                                            <span class="text-xs">
                                            {{ __('N. max partecipanti: ') }} {{ $this->availability_date->participants_per_vehicle }}
                                        </span>
                                        @endif
                                        <div x-on:click="open = !open" class="flex items-center justify-between">
                                            <h5 class="text-sm font-semibold">{{ trans_choice('[*] Partecipanti x :count', $this->participants) }}</h5>
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
                                                            class="text-sm text-1e2e33 min-w-4 text-center">{{ $adults }}</span>
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
                                                            class="text-sm text-1e2e33 min-w-4 text-center">{{ $kids }}</span>
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
                                                            class="text-sm text-1e2e33 min-w-4 text-center">{{ $children }}</span>
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
                                    {{--                                @if($this->participants && $time)--}}
                                    <div class="flex items-center justify-between text-sm text-0d171a py-6">
                                        <span>{{ __('Totale') }}</span>
                                        <span class="font-semibold">{{ money($this->total, forceDecimals: true) }}</span>
                                    </div>
                                    {{--                                @endif--}}
                                </div>
                            </div>
                        @endif
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
                        <div class="py-6 text-center">
                            <x-tripsy-button
                                wire:click="checkAvailability"
                                color="orange"
                                class="shadow-md"
                                :disabled="!$date || !$time || $this->participants <= 0"
                            >{{ __('Aggiungi al carrello') }}</x-tripsy-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-fafcfc border-y border-e2eaeb">
        <div class="container grid grid-cols-12 gap-8 pt-5 pb-9">
            <div class="col-span-9">
                <h3 class="text-2xl text-00abc0 font-semibold">{{ __('La tua esperienza') }}</h3>
                <div class="ml-4 mt-9 divide-y divide-e2eaeb">
                    <div class="flex py-5 first:pt-0 last:pb-0">
                        <div class="min-w-56 font-medium text-sm">{{ __('In evidenza') }}</div>
                        <ul class="*:text-0d171a *:text-sm space-y-1">
                            <li>Visita Cala Luna, Cala Mariolu e Cala Biriola</li>
                            <li>12 personea bordo</li>
                            <li>Dirigetevi verso alcune delle spiagge più pittoresche</li>
                            <li>Siediti e rilassati ammirando il paesaggio</li>
                            <li>Fai una nuotata rinfrescante nell'oceano per rinfrescarti</li>
                        </ul>
                    </div>
                    {{--                    <div class="flex py-5 first:pt-0 last:pb-0">--}}
                    {{--                        <div class="min-w-56 font-medium text-sm">{{ __('Descrizione completa') }}</div>--}}
                    {{--                        <p class="text-0d171a text-sm">{!! $product->description !!}</p>--}}
                    {{--                    </div>--}}
                    @if($product->included_services->count())
                        <div class="flex py-5 first:pt-0 last:pb-0">
                            <div class="min-w-56 font-medium text-sm">{{ __('Cosa è incluso') }}</div>
                            <ul class="*:text-0d171a space-y-2">
                                @foreach($product->included_services as $service)
                                    <li class="flex space-x-2">
                                        <x-heroicon-o-check stroke-width="2.5" class="w-4 h-4 shrink-0 text-259332"/>
                                        <div>
                                            <h5 class="text-sm leading-none text-0d171a">
                                                {{ $service->name }}
                                            </h5>
                                            <p class="text-xs text-627277 leading-normal">
                                                {!! $service->description !!}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if($product->extra_services->count())
                        <div class="flex py-5 first:pt-0 last:pb-0">
                            <div class="min-w-56 font-medium text-sm">{{ __('Servizi aggiuntivi') }}</div>
                            <ul class="*:text-0d171a *:text-sm space-y-1 *:py-2 *:border-t border-e2eaeb w-full">
                                <li class="!border-t-0">{{ __('Puoi aggiungere alla tua esperienza alcuni servizi:') }}</li>
                                @foreach($product->extra_services as $service)
                                    <li class="{{ $loop->first ? '!border-t-0' : '' }}">
                                        <div>
                                            <h5 class="text-sm leading-none text-0d171a">
                                                {{ $service->name }}
                                                - {{ money($service->price, forceDecimals: true) }} {{ $service->price_type }}
                                            </h5>
                                            <p class="text-xs text-627277 leading-normal">
                                                {!! $service->description !!}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if($product->meeting_point)
                        <div class="flex py-5 first:pt-0 last:pb-0">
                            <div class="min-w-56 font-medium text-sm">{{ __('Punto di incontro') }}</div>
                            <div>
                                <p class="text-0d171a text-sm">
                                    {!! $product->meeting_point !!}
                                </p>
                                @if($product->meeting_point_coords)
                                    <a href="{{ $product->getGoogleMapsLink() }}"
                                       target="_blank"
                                       class="block text-xs text-00abc0 underline mt-2">{{ __('Apri in Google Maps') }}</a>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if($product->preliminary_informations)
                        <div class="flex py-5 first:pt-0 last:pb-0">
                            <div class="min-w-56 font-medium text-sm">{{ __('Info prima della prenotazione') }}</div>
                            <p>{{ $product->preliminary_informations }}</p>
                            {{--                            <ul class="*:text-0d171a *:text-sm space-y-1">--}}
                            {{--                                <li>Visita Cala Luna, Cala Mariolu e Cala Biriola</li>--}}
                            {{--                                <li>12 personea bordo</li>--}}
                            {{--                                <li>Dirigetevi verso alcune delle spiagge più pittoresche</li>--}}
                            {{--                                <li>Siediti e rilassati ammirando il paesaggio</li>--}}
                            {{--                                <li>Fai una nuotata rinfrescante nell'oceano per rinfrescarti</li>--}}
                            {{--                            </ul>--}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container grid grid-cols-12 gap-8 pt-5 pb-9">
            <div class="col-span-9">
                <h3 class="text-2xl text-00abc0 font-semibold">{{ __('Domande frequenti') }}</h3>
                <div class="ml-4 mt-9 divide-y divide-e2eaeb">
                    @foreach($product->faqs as $faq)
                        <div x-data="{open: false}" class="py-3">
                            <div x-on:click="open = !open" class="flex items-center justify-between hover:cursor-pointer">
                                <h4 class="text-sm font-medium text-0d171a">{{ $faq->title }}</h4>
                                <x-heroicon-o-chevron-down class="w-4 h-4 shrink-0 text-0d171a" x-bind:class="open ? 'rotate-180' : ''" stroke-width="2.5"/>
                            </div>
                            <div x-cloak x-show="open" class="mt-4">
                                <p class="text-sm text-627277">{{ $faq->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12">
                    <h3 class="text-2xl text-0d171a font-semibold">{{ __('Recensioni dei clienti') }}</h3>
                    @if($product->reviews->count())
                        <div class="flex items-center space-x-1 text-ffa14a mt-3">
                            <span class="font-semibold">{{ round($product->reviews->avg('rating'), 1) }}</span>
                            @php
                                $rating = $product->reviews->avg('rating');
                                $roundedRating = floor($rating);
                                $halfStar = ($rating - $roundedRating) >= 0.5;
                            @endphp
                            <div class="flex space-x-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $roundedRating)
                                        <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-current"/>
                                    @elseif($i == $roundedRating + 1 && $halfStar)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="url(#half-gradient)" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <defs>
                                                <linearGradient id="half-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                    <stop offset="50%" stop-color="#ffa14a"/>
                                                    <stop offset="50%" stop-color="#ffffff"/>
                                                </linearGradient>
                                            </defs>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                        </svg>
                                    @else
                                        <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-white"/>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-1e2e33">
                            {!! trans_choice(':count Recensione|[2,*] :count recensioni', $product->reviews->count(), ['count' => "<span class='font-bold'>{$product->reviews->count()}</span>"]) !!}
                        </p>
                        <div class="mt-10 divide-y divide-e2eaeb">
                            @foreach($product->reviews()->orderBy('created_at', 'desc')->get() as $review)
                                <div class="space-y-1 py-3">
                                    <span class="text-xs text-627277">{{ $review->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex space-x-0.5 text-ffa14a">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($review->rating))
                                                <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-current"/>
                                            @else
                                                <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-white"/>
                                            @endif
                                        @endfor
                                    </div>
                                    <h4 class="text-0d171a text-sm font-semibold">{{ $review->title }}</h4>
                                    <p class="text-0d171a text-sm">{{ $review->content }}</p>
                                    <div class="flex items-center space-x-3 mt-3">
                                        <div class="w-11 h-11 rounded-full shrink-0 bg-blue-300"></div>
                                        <div>
                                            <p class="text-xs text-627277">{{ __('Recensito da') }}</p>
                                            <p class="text-xs text-0d171a font-medium">{{ $review->user->full_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-3 text-sm text-0d171a">{{ __('Al momento non ci sono recensioni per questa esperienza.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('added-to-cart'))
    @script
    <script>
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        })
    </script>
    @endscript
@endif
