<div>
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-semibold text-0d171a hidden lg:block">{{ __('Gift Cards') }}</h3>
        <x-tripsy-button wire:click="$dispatch('openModal', {component: 'guest.pages.profile.modals.redeem-gift-card'})" color="black" class="space-x-2">
            <x-heroicon-o-plus class="w-4 h-4"/>
            <span>{{ __('Aggiungi') }}</span>
        </x-tripsy-button>
    </div>
    <hr class="my-3 hidden lg:block">
    <div class="space-y-5">
        <h3 class="text-xl text-0d171a">{{ __('Il tuo saldo:') }} <span class="text-ffa14a font-semibold">{{ money(auth()->user()->balance) }}</span></h3>
        @if($gift_cards->count())
            <div class="flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0 whitespace-nowrap">{{ __('Data') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-full whitespace-nowrap">{{ __('Descrizione') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 whitespace-nowrap">{{ __('Importo') }}</th>
                                {{--                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 whitespace-nowrap">{{ __('Saldo in chiusura') }}</th>--}}
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach($gift_cards as $gift_card)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $gift_card->redeemed_at->format('d/m/Y') }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <p class="block">{{ __('Gift Card aggiunta') }}</p>
                                        <p class="block">
                                            {!! __('Codice: <strong>:code</strong>', ['code' => $gift_card->redeem_code]) !!}
                                        </p>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ money($gift_card->card->value, forceDecimals: true) }}</td>
                                    {{--                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ money(5000) }}</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <p class="text-sm text-627277">{{ __('Nessuna Gift Card riscattata') }}</p>
        @endif
    </div>
</div>
