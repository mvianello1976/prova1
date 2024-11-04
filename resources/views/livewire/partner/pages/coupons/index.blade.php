<div>
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="border rounded bg-white p-8">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Coupons') }}</h3>
            <div class="mt-8">
                <h5 class="text-sm text-0d171a font-semibold">{{ __('Offri ai clienti dei coupons per un periodo limitato.') }}</h5>
                <p class="text-xs text-627277">{{ __('Sono facili e veloci da configurare') }}</p>
                <x-tripsy-button
                    href="{{ route('coupons.init.create') }}"
                    color="orange" class="mt-6">
                    {{ __('Crea un coupon') }}
                </x-tripsy-button>
            </div>
            <hr class="my-5">
            <div class="space-y-3">
                <h3 class="text-xl text-0d171a font-medium">{{ __('Coupons') }}</h3>
                <x-input
                    wire:model.live.debounce.200ms="search"
                    type="text" class="max-w-md" placeholder="{{ __('Cerca...') }}">
                    <x-slot:prepend>
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-627277"/>
                    </x-slot:prepend>
                </x-input>
                <div class="!mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            @if($coupons->count())
                                <table class="min-w-full divide-y divide-e2eaeb">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-2 pl-4 pr-3 text-left text-xs font-semibold text-b0b7be sm:pl-0">
                                            {{ __('Titolo') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                            {{ __('Attività') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                            {{ __('Validità') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                            {{ __('Stato') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                            {{ __('Tipo di Offerta') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($coupons as $coupon)
                                        <tr class="align-top">
                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a font-mono uppercase sm:pl-0">
                                                {{ $coupon->code }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">
                                                {{ $coupon->product->name }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">
                                                {{ "{$coupon->date_start->format('d/m/Y')} - {$coupon->date_end->format('d/m/Y')}" }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">
                                                @switch($coupon->used)
                                                    @case(false)
                                                        <span class="px-1.5 py-0.5 text-xs text-red-700 rounded bg-red-50 ring-1 ring-inset ring-red-600/10">{{ __('Non utilizzato') }}</span>
                                                        @break
                                                    @case(true)
                                                        <span class="px-1.5 py-0.5 text-xs text-green-700 rounded bg-green-50 ring-1 ring-inset ring-green-600/20">{{ __('Utilizzato') }}</span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">
                                                @switch($coupon->type)
                                                    @case('cash')
                                                        <div class="flex flex-col items-start gap-1">
                                                            <span class="px-1.5 py-0.5 text-xs text-0d171a rounded bg-d3ecff">- {{ money($coupon->value, forceDecimals: true) }}</span>
                                                        </div>
                                                        @break
                                                    @case('percentage')
                                                        <span class="px-1.5 py-0.5 text-xs text-0d171a rounded bg-d3ecff">- {{ $coupon->value }}%</span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="flex justify-end relative whitespace-nowrap py-2 pl-3 text-right text-xs font-medium">
                                                <div class="flex items-center space-x-1">
                                                    <div wire:confirm="{{ __('Sei sicuro di voler eliminare questo coupon?') }}" wire:click="deleteCoupon({{ $coupon->id }})" class="bg-fff2e6 text-e57868 py-1 px-1 rounded hover:text-white hover:cursor-pointer hover:bg-e57868">
                                                        <x-heroicon-o-trash class="w-4 h-4"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-sm text-0d171a">
                                    {{ __('Nessun risultato trovato') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
