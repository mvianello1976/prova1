<div>
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-semibold text-0d171a hidden lg:block">{{ __('Prenotazioni') }}</h3>
        <x-tripsy-button wire:click="$dispatch('openModal', {component: 'guest.pages.profile.modals.redeem-gift'})" color="black">
            {{ __('Riscatta regalo') }}
        </x-tripsy-button>
    </div>
    <hr class="my-3 hidden lg:block">
    <div class="space-y-5">
        <div class="flex items-center space-x-4">
            <div wire:click="$set('currentTab', 'scheduled')" class="{{ $currentTab == 'scheduled' ? 'text-00abc0 border-00abc0' : 'text-b0b7be border-b0b7be' }} text-xs font-semibold bg-fafcfc border rounded-full px-6 py-2 hover:cursor-pointer">{{ __('In Programma') }}</div>
            <div wire:click="$set('currentTab', 'past')" class="{{ $currentTab == 'past' ? 'text-00abc0 border-00abc0' : 'text-b0b7be border-b0b7be' }} text-xs font-semibold bg-fafcfc border rounded-full px-6 py-2 hover:cursor-pointer">{{ __('Eventi passati') }}</div>
            <div wire:click="$set('currentTab', 'gift')" class="{{ $currentTab == 'gift' ? 'text-00abc0 border-00abc0' : 'text-b0b7be border-b0b7be' }} text-xs font-semibold bg-fafcfc border rounded-full px-6 py-2 hover:cursor-pointer">{{ __('Regali effettuati') }}</div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            @forelse($orders as $order)
                @php($product = \App\Models\Product::withTrashed()->find($order->data['product']['id']) ?? null)
                @if($product)
                    <div class="flex flex-col items-start space-y-4 p-4 bg-white rounded-md border border-e2eaeb col-span-2 md:flex-row md:col-span-1 md:space-x-4">
                        <div class="flex items-center space-x-3">
                            <div class="relative w-16 aspect-square md:w-36 md:h-[95px] rounded-md overflow-hidden shrink-0">
                                <img src="{{ Storage::url($product->main_image->path)}}"
                                     class="absolute w-full h-full inset-0 object-cover"
                                     alt="">
                                @if($order->is_gift)
                                    <div
                                        x-data
                                        x-tooltip.raw="{{ $order->isReceivedGift() ? __('Regalo da :name', ['name' => $order->sender->fullname]) : __('Regalo a :name', ['name' => $order->gift_data['receiver_name']]) }}"
                                        class="absolute top-1 left-1 grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full hover:cursor-help">
                                        <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-2 md:hidden">
                                <div
                                    class="flex items-center space-x-1 text-xs text-00abc0 font-semibold uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                    </svg>
                                    <span
                                        class="truncate">{{ $order->data['product']['destination'] }}</span>
                                </div>
                                <span
                                    class="block text-0d171a font-semibold text-sm">{{ $order->data['product']['name'] }}</span>
                            </div>
                        </div>
                        <div class="flex items-start w-full min-h-[100px] justify-between">
                            <div class="flex-1 space-y-2">
                                <div
                                    class="hidden items-center space-x-1 text-xs text-00abc0 font-semibold uppercase md:flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                    </svg>
                                    <span
                                        class="truncate">{{ $order->data['product']['destination'] }}</span>
                                </div>
                                <span
                                    class="hidden text-0d171a font-semibold text-sm md:block">{{ $order->data['product']['name'] }}</span>
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="flex items-start space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor" class="w-4 h-4 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                                        </svg>
                                        <div class="flex flex-col">
                            <span class="text-sm text-0d171a leading-tight">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $order->data['booking']['date'])->translatedFormat('d F Y') }}
                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor" class="w-4 h-4 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <div class="flex flex-col">
                            <span class="text-sm text-0d171a leading-tight">
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $order->data['booking']['time'])->format('H:i') }}
                            </span>
                                        </div>
                                    </div>
                                    @if($order->data['booking']['participants']['adults'])
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor" class="w-4 h-4 shrink-0">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                </svg>
                                                <div class="flex flex-col">
                                    <span class="text-sm text-0d171a leading-tight">
                                        {{ trans_choice('{1} :count adulto|[2,*] :count adulti', $order->data['booking']['participants']['adults']) }}
                                        <span class="text-627277">({{ __('Età 17+ anni') }})</span>
                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($order->data['booking']['participants']['kids'])
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor" class="w-4 h-4 shrink-0">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                </svg>
                                                <div class="flex flex-col">
                                    <span class="text-sm text-0d171a leading-tight">
                                        {{ trans_choice('{1} :count ragazzo|[2,*] :count ragazzi', $order->data['booking']['participants']['kids']) }}
                                        <span class="text-627277">({{ __('Età 8-16 anni') }})</span>
                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($order->data['booking']['participants']['children'])
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor" class="w-4 h-4 shrink-0">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                </svg>
                                                <div class="flex flex-col">
                                    <span class="text-sm text-0d171a leading-tight">
                                        {{ trans_choice('{1} :count bambino|[2,*] :count bambini', $order->data['booking']['participants']['children']) }}
                                        <span class="text-627277">({{ __('Fino a 7 anni') }})</span>
                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(!$order->isReceivedGift())
                                        <div class="flex items-start space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor" class="w-4 h-4 shrink-0">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 6h.008v.008H6V6Z"/>
                                            </svg>
                                            <div class="flex flex-col">
                                                @if($order->payment_method === 'cash')
                                                    <div>
                                                        <span class="text-sm text-0d171a leading-tight">
                                                            {{ money($order->deposit, forceDecimals: true) }}
                                                        </span>
                                                        <span class="text-xs">({{ __('A titolo di anticipo') }})</span>
                                                    </div>
                                                @else
                                                    <span class="text-sm text-0d171a leading-tight">
                                                        {{ money($order->total, forceDecimals: true) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <hr class="!my-3">
                                @if($order->is_gift)
                                    @if(!$order->isReceivedGift())
                                        @if(!$order->redeemed)
                                            <div class="flex flex-col space-y-1 text-center">
                                                <p class="text-xs text-0d171a">{{ __('Codice di riscatto') }}</p>
                                                <span class="text-sm text-0d171a font-semibold font-mono">{{ $order->redeem_code }}</span>
                                            </div>
                                        @else
                                            <div class="flex flex-col space-y-1 text-center">
                                                <p class="text-xs text-0d171a">{{ __('Regalo riscattato il') }}</p>
                                                <span class="text-sm text-0d171a font-semibold font-mono">{{ $order->redeemed_at->format('d/m/Y H:i:s') }}</span>
                                            </div>
                                        @endif
                                    @else
                                        @if($order->data['booking']['date'] >= now()->format('Y-m-d'))
                                            <div class="text-center">
                                                <x-tripsy-button href="{{ route('guest.tickets', ['order' => $order->uuid]) }}" target="_blank" color="fluoblue" class="space-x-2">
                                                    <x-heroicon-o-arrow-down-tray class="w-4 h-4"/>
                                                    <span>{{ __('Scarica i tuoi biglietti') }}</span>
                                                </x-tripsy-button>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                @if($review = auth()->user()->has_reviewed_product($order->data['product']['id']))
                                                    <div class="space-y-1">
                                                        <span class="text-xs text-627277">{{ __('Hai recensito questa esperienza') }}</span>
                                                        <div class="flex justify-center space-x-0.5 text-ffa14a">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= round($review->rating))
                                                                    <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-current"/>
                                                                @else
                                                                    <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-white"/>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                @else
                                                    <x-tripsy-button wire:click="$dispatch('openModal', {component: 'guest.pages.profile.modals.write-review', arguments: {product: {{ $order->data['product']['id'] }}}})" color="orange" class="space-x-2">
                                                        <x-heroicon-o-pencil class="w-4 h-4"/>
                                                        <span>{{ __('Scrivi una recensione') }}</span>
                                                    </x-tripsy-button>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if($order->data['booking']['date'] >= now()->format('Y-m-d'))
                                        <div class="text-center">
                                            <x-tripsy-button href="{{ route('guest.tickets', ['order' => $order->uuid]) }}" target="_blank" color="fluoblue" class="space-x-2">
                                                <x-heroicon-o-arrow-down-tray class="w-4 h-4"/>
                                                <span>{{ __('Scarica i tuoi biglietti') }}</span>
                                            </x-tripsy-button>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            @if($review = auth()->user()->has_reviewed_product($order->data['product']['id']))
                                                <div class="space-y-1">
                                                    <span class="text-xs text-627277">{{ __('Hai recensito questa esperienza') }}</span>
                                                    <div class="flex justify-center space-x-0.5 text-ffa14a">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= round($review->rating))
                                                                <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-current"/>
                                                            @else
                                                                <x-heroicon-o-star class="w-5 h-5 shrink-0 fill-white"/>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            @else
                                                <x-tripsy-button wire:click="$dispatch('openModal', {component: 'guest.pages.profile.modals.write-review', arguments: {product: {{ $order->data['product']['id'] }}}})" color="orange" class="space-x-2">
                                                    <x-heroicon-o-pencil class="w-4 h-4"/>
                                                    <span>{{ __('Scrivi una recensione') }}</span>
                                                </x-tripsy-button>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-sm text-627277">{{ __('Nessun risultato') }}</p>
            @endforelse
        </div>
    </div>
</div>
