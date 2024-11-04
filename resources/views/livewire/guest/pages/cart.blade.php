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
        <div class="flex items-center space-x-2 pb-10">
            <h1 class="text-2xl font-bold text-1e2e33">{{ __('Carrello') }}</h1>
            <span class="text-sm text-627277">
                ({{ trans_choice('{1} :count articolo|[2,*] :count articoli', $cart?->items->count() ?? 0) }})
            </span>
        </div>
        @if($cart?->items)
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-8 space-y-4">
                    @forelse($cart->items as $cart_item)
                        @switch($cart_item->type)
                            @case('product')
                                <div class="w-full bg-white rounded-md shadow-md p-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative w-44 h-[110px] rounded-md overflow-hidden shrink-0">
                                            <img src="{{Storage::url($cart_item->product->mainImage->path)}}" class="absolute w-full h-full inset-0 object-cover"
                                                 alt="">
                                            @if($cart_item->gift)
                                                <div
                                                    class="absolute top-1 left-1 grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full">
                                                    <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex items-center w-full h-[100px] justify-between border-b">
                                            <div class="space-y-2">
                                                <div
                                                    class="flex items-center space-x-1 text-xs text-00abc0 font-semibold uppercase">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                                    </svg>
                                                    <span class="truncate">{{ $cart_item->product->destination->name }}</span>
                                                </div>
                                                <span
                                                    class="block text-0d171a font-semibold text-sm">{{ $cart_item->product->name }}</span>
                                            </div>
                                            <div class="space-y-2">
                                        <span
                                            class="block text-xs text-0d171a font-semibold uppercase">{{ money($cart_item->total_price, forceDecimals: true) }}</span>
                                                <span
                                                    wire:click="delete({{$cart_item->id}})"
                                                    class="block text-xs text-ff7968 text-right font-semibold underline hover:cursor-pointer">{{ __('Elimina') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-00abc0 font-semibold">{{ __('Dettagli') }}</span>
                                                <div
                                                    class="flex items-center space-x-1 text-xs text-ffbb7c font-semibold hover:cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                                    </svg>
                                                    <span wire:click="$dispatch('openModal', { component: 'guest.modals.edit-cart-item', arguments: { cart_item: {{ $cart_item->id }}}})" class="truncate">{{ __('Modifica') }}</span>
                                                </div>
                                            </div>
                                            <div class="space-y-3">
                                                <div class="flex items-start space-x-4">
                                                    <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                                                    <div class="flex flex-col">
                                                <span
                                                    class="text-sm text-0d171a leading-tight">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cart_item->time->date)->translatedFormat('d F Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-start space-x-4">
                                                    <x-heroicon-o-clock class="w-4 h-4 shrink-0"/>
                                                    <div class="flex flex-col">
                                                    <span
                                                        class="text-sm text-0d171a leading-tight">{{ \Carbon\Carbon::createFromFormat('H:i:s', $cart_item->time->time)->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-start space-x-4">
                                                    <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                                                    <div class="flex flex-col">
                                                    <span class="text-sm text-0d171a leading-tight">
                                                        {{ config("tripsytour.cancellations.{$cart_item->product->cancellation}.label") }}
                                                    </span>
                                                        <span class="text-xs text-627277">
                                                        {{-- TODO: Inserire logica di calcolo orario cancellazione --}}
                                                        (prima delle 09:00 del 20 luglio 2024)
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="flex items-start space-x-4">
                                                    @if($cart_item->product->payment_type === 'online')
                                                        <x-heroicon-o-credit-card class="w-4 h-4 shrink-0"/>
                                                    @else
                                                        <x-heroicon-o-banknotes class="w-4 h-4 shrink-0"/>
                                                    @endif
                                                    <div class="flex flex-col">
                                                    <span class="text-sm text-0d171a leading-tight">
                                                        {{ __('Metodo di pagamento') }}
                                                    </span>
                                                        <span class="text-xs text-627277">
                                                        {{ config("tripsytour.product.payment_types.{$cart_item->product->payment_type}.label") }}
                                                    </span>
                                                    </div>
                                                </div>
                                                @if($cart_item->adults)
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                 stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4 shrink-0">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                    <span class="text-sm text-0d171a leading-tight">
                                                        {{ trans_choice('{1} :count adulto|[2,*] :count adulti', $cart_item->adults) }}
                                                        <span class="text-627277">({{ __('Età 17+ anni') }})</span>
                                                    </span>
                                                            </div>
                                                        </div>
                                                        @if(!$cart_item->product->isRental())
                                                            <div class="flex flex-col items-end space-y-0.5">
                                                            <span
                                                                class="text-sm text-0d171a font-semibold leading-none">{{ $cart_item->time->getAdultsPrice() == 0 ? 'Gratis' : money($cart_item->adults * $cart_item->time->getAdultsPrice(), forceDecimals: true) }}</span>
                                                                @if($cart_item->time->getAdultsPrice() == 0)
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ __('Gratis') }}</span>
                                                                @else
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ "$cart_item->adults x"}} {{ money($cart_item->time->getAdultsPrice(), forceDecimals: true) }}</span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($cart_item->kids)
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                 stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4 shrink-0">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                        <span class="text-sm text-0d171a leading-tight">
                                                            {{ trans_choice('{1} :count ragazzo|[2,*] :count ragazzi', $cart_item->kids) }}
                                                            <span class="text-627277">({{ __('Età 8-16 anni') }})</span>
                                                        </span>
                                                            </div>
                                                        </div>
                                                        @if(!$cart_item->product->isRental())
                                                            <div class="flex flex-col items-end space-y-0.5">
                                                            <span
                                                                class="text-sm text-0d171a font-semibold leading-none">{{ $cart_item->time->getKidsPrice() == 0 ? 'Gratis' : money($cart_item->kids * $cart_item->time->getKidsPrice(), forceDecimals: true) }}</span>
                                                                @if($cart_item->time->getKidsPrice() == 0)
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ __('Gratis') }}</span>
                                                                @else
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ "$cart_item->kids x"}} {{ money($cart_item->time->getKidsPrice(), forceDecimals: true) }}</span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if($cart_item->children)
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                 stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4 shrink-0">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                            </svg>
                                                            <div class="flex flex-col">
                                                        <span class="text-sm text-0d171a leading-tight">
                                                            {{ trans_choice('{1} :count bambino|[2,*] :count bambini', $cart_item->children) }}
                                                            <span class="text-627277">({{ __('Fino a 7 anni') }})</span>
                                                        </span>
                                                            </div>
                                                        </div>
                                                        @if(!$cart_item->product->isRental())
                                                            <div class="flex flex-col items-end space-y-0.5">
                                                            <span
                                                                class="text-sm text-0d171a font-semibold leading-none">{{ $cart_item->time->getChildrenPrice() == 0 ? 'Gratis' : money($cart_item->children * $cart_item->time->getChildrenPrice(), forceDecimals: true) }}</span>
                                                                @if($cart_item->time->getChildrenPrice() == 0)
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ __('Gratis') }}</span>
                                                                @else
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ "$cart_item->children x"}} {{ money($cart_item->time->getChildrenPrice(), forceDecimals: true) }}</span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            @if(count(json_decode($cart_item->services)))
                                                <div class="!mt-5">
                                                    <h3 class="text-sm text-00abc0 font-semibold">
                                                        {{ __('Servizi aggiuntivi') }}
                                                    </h3>
                                                    <div class="space-y-2 mt-2">
                                                        @foreach(json_decode($cart_item->services, true) as $s)
                                                            @php
                                                                $service = \App\Models\Service::find($s)
                                                            @endphp
                                                            <div class="flex items-center justify-between">
                                                                <div class="flex items-center space-x-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                         viewBox="0 0 24 24"
                                                                         stroke-width="1.5"
                                                                         stroke="currentColor" class="w-4 h-4 shrink-0">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                              d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                                    </svg>
                                                                    <span
                                                                        class="text-sm text-0d171a leading-tight">{{ config("tripsytour.services.$service->type.$service->item.label") }}</span>
                                                                </div>
                                                                <div class="flex flex-col items-end space-y-0.5">
                                                            <span
                                                                class="text-sm text-0d171a font-semibold leading-none">{{ money($service->price, forceDecimals: true) }}</span>
                                                                    <span
                                                                        class="text-[10px] text-627277 leading-none">{{ $service->price_type }}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if($cart_item->product->extra_services->count())
                                            <div class="mt-4">
                                                <div
                                                    wire:click="$dispatch('openModal', {component: 'common.modals.edit-extra-services-modal', arguments: {cartItem: {{ $cart_item }},product: {{$cart_item->product_id}} }})"
                                                    class="flex items-center space-x-1 text-xs text-00abc0 font-semibold hover:cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                                    </svg>
                                                    <span class="truncate">{{ __('Aggiungi servizi') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($cart_item->gift)
                                            <div class="space-y-2 border-t mt-3 pt-3">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-00abc0 font-semibold">{{ __('Dettagli Regalo') }}</span>
                                                    @if($cart_item->receiver_name || $cart_item->receiver_email)
                                                        <div
                                                            class="flex items-center space-x-1 text-xs text-ffbb7c font-semibold hover:cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                                            </svg>
                                                            <span wire:click="$dispatch('openModal', { component: 'guest.modals.edit-gift-data', arguments: { cart_item: {{ $cart_item->id }}}})" class="truncate">{{ __('Modifica') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if(!$cart_item->receiver_name || !$cart_item->receiver_email)
                                                    <div class="rounded-md bg-yellow-50 p-4">
                                                        <div class="flex">
                                                            <div class="flex-shrink-0">
                                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                            <div class="ml-3">
                                                                <h3 class="text-sm font-medium text-yellow-800">{{ __('Dati mancanti') }}</h3>
                                                                <div class="mt-2 text-sm text-yellow-700">
                                                                    <p>{{ __('Per proseguire, inserire i dati richiesti.') }}</p>
                                                                    <p wire:click="$dispatch('openModal', { component: 'guest.modals.edit-gift-data', arguments: { cart_item: {{ $cart_item->id }}}})" class="underline mt-1 hover:cursor-pointer">{{ __('Aggiungili subito!') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="space-y-3">
                                                    @if($cart_item->receiver_name && $cart_item->receiver_email)
                                                        <div class="flex items-start space-x-4">
                                                            <x-heroicon-o-user class="w-4 h-4 shrink-0"/>
                                                            <div class="flex flex-col">
                                                                <span class="text-sm text-0d171a font-semibold leading-tight">{{ __('Dedicato a: ') }}</span>
                                                                <p class="text-sm text-0d171a leading-tight mt-1">
                                                                    {{ $cart_item->receiver_name }}
                                                                    <span class="text-627277">({{ $cart_item->receiver_email }})</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($cart_item->receiver_message)
                                                        <div class="flex items-start space-x-4">
                                                            <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 shrink-0"/>
                                                            <div class="flex flex-col">
                                                                <span class="text-sm text-0d171a font-semibold leading-tight">{{ __('Messaggio: ') }}</span>
                                                                <p class="text-sm text-0d171a leading-tight mt-1">{{ $cart_item->receiver_message }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @break
                            @case('gift-card')
                                <div class="w-full bg-white rounded-md shadow-md p-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative grid place-items-center w-44 h-[110px] rounded-md bg-ffa368 overflow-hidden shrink-0">
                                            <x-heroicon-o-gift class="h-16 w-16 text-fff4ed"/>
                                            @if($cart_item->gift)
                                                <div
                                                    class="absolute top-1 left-1 grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full">
                                                    <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex items-center w-full h-[100px] justify-between border-b">
                                            <div class="space-y-2">
                                                <span
                                                    class="block text-0d171a font-semibold text-sm">{{ __('Gift Card') }}</span>
                                            </div>
                                            <div class="space-y-2">
                                                <span class="block text-xs text-0d171a font-semibold uppercase">{{ money($cart_item->total_price, forceDecimals: true) }}</span>
                                                <span
                                                    wire:click="delete({{$cart_item->id}})"
                                                    class="block text-xs text-ff7968 text-right font-semibold underline hover:cursor-pointer">{{ __('Elimina') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        @if($cart_item->gift)
                                            <div class="space-y-2">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-00abc0 font-semibold">{{ __('Dettagli Regalo') }}</span>
                                                    @if($cart_item->receiver_name || $cart_item->receiver_email)
                                                        <div
                                                            class="flex items-center space-x-1 text-xs text-ffbb7c font-semibold hover:cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                                            </svg>
                                                            <span wire:click="$dispatch('openModal', { component: 'guest.modals.edit-gift-data', arguments: { cart_item: {{ $cart_item->id }}}})" class="truncate">{{ __('Modifica') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if(!$cart_item->receiver_name || !$cart_item->receiver_email)
                                                    <div class="rounded-md bg-yellow-50 p-4">
                                                        <div class="flex">
                                                            <div class="flex-shrink-0">
                                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                            <div class="ml-3">
                                                                <h3 class="text-sm font-medium text-yellow-800">{{ __('Dati mancanti') }}</h3>
                                                                <div class="mt-2 text-sm text-yellow-700">
                                                                    <p>{{ __('Per proseguire, inserire i dati richiesti.') }}</p>
                                                                    <p wire:click="$dispatch('openModal', { component: 'guest.modals.edit-gift-data', arguments: { cart_item: {{ $cart_item->id }}}})" class="underline mt-1 hover:cursor-pointer">{{ __('Aggiungili subito!') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="space-y-3">
                                                    @if($cart_item->receiver_name && $cart_item->receiver_email)
                                                        <div class="flex items-start space-x-4">
                                                            <x-heroicon-o-user class="w-4 h-4 shrink-0"/>
                                                            <div class="flex flex-col">
                                                                <span class="text-sm text-0d171a font-semibold leading-tight">{{ __('Dedicato a: ') }}</span>
                                                                <p class="text-sm text-0d171a leading-tight mt-1">
                                                                    {{ $cart_item->receiver_name }}
                                                                    <span class="text-627277">({{ $cart_item->receiver_email }})</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($cart_item->receiver_message)
                                                        <div class="flex items-start space-x-4">
                                                            <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 shrink-0"/>
                                                            <div class="flex flex-col">
                                                                <span class="text-sm text-0d171a font-semibold leading-tight">{{ __('Messaggio: ') }}</span>
                                                                <p class="text-sm text-0d171a leading-tight mt-1">{{ $cart_item->receiver_message }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @break
                        @endswitch
                    @empty
                        <p class="text-sm text-627277">{{ __('Nessun prodotto in carrello') }}</p>
                    @endforelse
                </div>
                <div class="col-span-4">
                    <div class="w-full bg-white rounded-md shadow-md p-4 divide-y divide-e2eaeb">
                        <div class="py-1 space-y-1 divide-y divide-e2eaeb">
                            @foreach($cart->items as $item)
                                @switch($item->type)
                                    @case('product')
                                        <div class="py-1" wire:key="{{$item->id}}">
                                            <div class="flex items-start justify-between text-xs text-0d171a">
                                                <span class="font-medium">{{ $item->product->name }}</span>
                                                <span class="{{ $item->product->payment_type === 'online' ? '' : 'line-through' }} {{ $item->coupon ? 'line-through' : '' }}">
                                                {{ money($item->total_price, forceDecimals: true) }}
                                            </span>
                                            </div>
                                            @if($item->coupon)
                                                <div class="ml-1 flex items-start justify-between text-xs text-0d171a py-1">
                                                    <div>
                                                        <x-heroicon-m-x-circle wire:click="removeCoupon({{ $item->id }})" class="inline-block w-4 h-4 text-red-500 hover:cursor-pointer"/>
                                                        <span class="font-bold font-mono bg-gray-200 px-1 py-0.5 rounded-md mx-0.5">{{ $item->coupon['code'] }}</span>
                                                        @switch($item->coupon['type'])
                                                            @case('percentage')
                                                                <span class="text-gray-500 !font-sans">(-{{ $item->coupon['value'] }}%)</span>
                                                                @break
                                                            @case('cash')
                                                                <span class="text-gray-500 !font-sans">(-{{ money($item->coupon['value'], forceDecimals: true) }})</span>
                                                                @break
                                                        @endswitch
                                                    </div>
                                                    @if($item->product->payment_type === 'cash')
                                                        @if($item->coupon['type'] === 'percentage')
                                                            <span class="line-through">{{ money($item->showPriceAfterDiscount(), forceDecimals: true) }}</span>
                                                        @elseif($item->coupon['type'] === 'cash')
                                                            <span class="line-through">{{ money($item->showPriceAfterDiscount(), forceDecimals: true) }}</span>
                                                        @endif
                                                    @elseif($item->product->payment_type === 'online')
                                                        @if($item->coupon['type'] === 'percentage')
                                                            <span>{{ money($item->showPriceAfterDiscount(), forceDecimals: true) }}</span>
                                                        @elseif($item->coupon['type'] === 'cash')
                                                            <span>{{ money($item->showPriceAfterDiscount(), forceDecimals: true) }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif
                                            @if($item->product->payment_type === 'cash')
                                                <div class="flex items-start justify-between text-xs text-0d171a py-1">
                                                    <div class="ml-1 flex space-x-2 leading-none">
                                                        <p>{{ __('Anticipo pagamento in contanti') }}</p>
                                                        @php
                                                            $text = "Per questa prenotazione con ". env('APP_NAME') . ", la caparra viene pagata online tramite il sistema di pagamento elettronico. Il saldo rimanente dell'importo totale sarà pagato in contanti al momento dell'arrivo."
                                                        @endphp
                                                        <button x-data x-tooltip.raw="{{ $text }}">
                                                            <x-heroicon-c-question-mark-circle class="w-3 h-3 text-627277"/>
                                                        </button>
                                                    </div>
                                                    @if($item->coupon)
                                                        <span>{{ money($item->calculateDeposit($item->showPriceAfterDiscount()), forceDecimals: true) }}</span>
                                                    @else
                                                        <span>{{ money($item->calculateDeposit($item->total_price), forceDecimals: true) }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        @break
                                    @case('gift-card')
                                        <div class="py-1" wire:key="{{$item->id}}">
                                            <div class="flex items-start justify-between text-xs text-0d171a">
                                                <span class="font-medium">{{ __('Gift Card') }}</span>
                                                <span>{{ money($item->total_price, forceDecimals: true) }}</span>
                                            </div>
                                        </div>
                                @endswitch
                            @endforeach
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
                        <div class="py-4 space-y-4">
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-4 h-4 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                </svg>
                                <div class="flex flex-col">
                                <span class="text-sm text-0d171a font-medium leading-tight">
                                    {{ __('Metodo di pagamento sicuro') }}
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="pt-8 pb-4 text-center">
                            <x-tripsy-button wire:click="goToCheckout" color="blue">{{ __('Vai al checkout') }}</x-tripsy-button>
                            @error('gift_data_missing')
                            <div class="!text-left border-l-4 border-red-400 bg-red-50 p-4 mt-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">
                                            {{ $message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="border rounded bg-white p-8">
                <div class="grid grid-cols-3 items-center">
                    <div class="col-span-2">
                        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Non ci sono ancora avventure nel tuo carrello.') }}<br>{{ __('Rimediamo?') }}</h3>
                        <p class="text-sm text-1e2e33 mt-8 mb-6 max-w-md">
                            {{ __('Tante esperienze fantastiche aspettano solo te.') }}
                        </p>
                        <x-tripsy-button href="{{ route('guest.index') }}" color="orange">
                            {{ __('Esplora tutte le attività migliori') }}
                        </x-tripsy-button>
                    </div>
                    <div class="col-span-1 text-center">
                        immagine
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
