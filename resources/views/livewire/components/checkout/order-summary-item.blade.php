<div class="flex items-start space-x-4 py-4">
    @switch($item->type)
        @case('product')
            <div class="relative w-36 h-[95px] rounded-md overflow-hidden shrink-0">
                <img src="{{ Storage::url($item->product->mainImage->path) }}"
                     class="absolute w-full h-full inset-0 object-cover"
                     alt="">
                @if($item->gift)
                    <div
                        x-data
                        x-tooltip.raw="{{ __('Regalo a :name', ['name' => $item->receiver_name]) }}"
                        class="absolute top-1 left-1 grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full hover:cursor-help">
                        <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                    </div>
                @endif
            </div>
            <div class="flex items-start w-full min-h-[100px] justify-between">
                <div class="flex-1 space-y-2">
                    <div
                        class="flex items-center space-x-1 text-xs text-00abc0 font-semibold uppercase">
                        <x-heroicon-o-map-pin class="w-4 h-4 shrink-0"/>
                        <span
                            class="truncate">{{ $item->product->destination->name }}</span>
                    </div>
                    <span
                        class="block text-0d171a font-semibold text-sm">{{ $item->product->name }}</span>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="flex items-start space-x-2">
                            <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                        <span class="text-sm text-0d171a leading-tight">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->time->date)->translatedFormat('d F Y') }}
                        </span>
                            </div>
                        </div>
                        <div class="flex items-start space-x-2">
                            <x-heroicon-o-clock class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                        <span class="text-sm text-0d171a leading-tight">
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $item->time->time)->format('H:i') }}
                        </span>
                            </div>
                        </div>
                        @if($item->adults)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <x-heroicon-o-users class="w-4 h-4 shrink-0"/>
                                    <div class="flex flex-col">
                                <span class="text-sm text-0d171a leading-tight">
                                    {{ trans_choice('{1} :count adulto|[2,*] :count adulti', $item->adults) }}
                                    <span class="text-627277">({{ __('Età 17+ anni') }})</span>
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($item->kids)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <x-heroicon-o-users class="w-4 h-4 shrink-0"/>
                                    <div class="flex flex-col">
                                <span class="text-sm text-0d171a leading-tight">
                                    {{ trans_choice('{1} :count ragazzo|[2,*] :count ragazzi', $item->kids) }}
                                    <span class="text-627277">({{ __('Età 8-16 anni') }})</span>
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($item->children)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <x-heroicon-o-users class="w-4 h-4 shrink-0"/>
                                    <div class="flex flex-col">
                                <span class="text-sm text-0d171a leading-tight">
                                    {{ trans_choice('{1} :count bambino|[2,*] :count bambini', $item->children) }}
                                    <span class="text-627277">({{ __('Fino a 7 anni') }})</span>
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($item->coupon)
                            <div class="flex items-start space-x-2">
                                <x-heroicon-o-receipt-percent class="w-4 h-4 shrink-0"/>
                                <div class="-mt-1">
                                    <span class="text-sm font-bold font-mono bg-gray-200 px-1 py-0.5 rounded-md mx-0.5">{{ $item->coupon['code'] }}</span>
                                    @if($editCoupon)
                                        <x-heroicon-m-x-circle wire:click="removeCoupon" class="inline-block w-4 h-4 text-red-500 hover:cursor-pointer"/>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="flex items-start space-x-2">
                            <x-heroicon-o-tag class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                @if($item->product->payment_type === 'cash')
                                    @if($item->coupon)
                                        @if($item->coupon['type'] === 'percentage')
                                            <span class="text-sm text-0d171a leading-tight">{{ money($item->calculateDeposit($item->showPriceAfterDiscount()), forceDecimals: true) }}</span>
                                        @elseif($item->coupon['type'] === 'cash')
                                            <span class="text-sm text-0d171a leading-tight">{{ money($item->calculateDeposit($item->showPriceAfterDiscount()), forceDecimals: true) }}</span>
                                        @endif
                                    @else
                                        <span>{{ money($item->calculateDeposit($item->total_price), forceDecimals: true) }}</span>
                                    @endif
                                    <span class="text-xs">({{ __('A titolo di anticipo') }})</span>
                                @elseif($item->product->payment_type === 'online')
                                    @if($item->coupon)
                                        @if($item->coupon['type'] === 'percentage')
                                            <span class="text-sm text-0d171a leading-tight">{{ money($item->showPriceAfterDiscount(), forceDecimals: true) }}</span>
                                        @elseif($item->coupon['type'] === 'cash')
                                            <span class="text-sm text-0d171a leading-tight">{{ money($item->showPriceAfterDiscount(), forceDecimals: true) }}</span>
                                        @endif
                                    @else
                                        <span class="text-sm text-0d171a leading-tight">{{ money($item->total_price, forceDecimals: true) }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @break
        @case('gift-card')
            <div class="relative grid place-items-center w-36 h-[95px] rounded-md bg-ffa368 overflow-hidden shrink-0">
                <x-heroicon-o-gift class="h-16 w-16 text-fff4ed"/>
                @if($item->gift)
                    <div
                        x-data
                        x-tooltip.raw="{{ __('Regalo a :name', ['name' => $item->receiver_name]) }}"
                        class="absolute top-1 left-1 grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full hover:cursor-help">
                        <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                    </div>
                @endif
            </div>
            <div class="flex items-start w-full min-h-[100px] justify-between">
                <div class="flex-1 space-y-2">
                    <span
                        class="block text-0d171a font-semibold text-sm">{{ __('Gift Card') }}</span>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="flex items-start space-x-2">
                            <x-heroicon-o-tag class="w-4 h-4 shrink-0"/>
                            <div class="flex flex-col">
                                <span class="text-sm text-0d171a leading-tight">{{ money($item->total_price, forceDecimals: true) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @break
    @endswitch
</div>
