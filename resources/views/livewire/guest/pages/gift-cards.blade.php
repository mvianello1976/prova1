<div>
    @if(session()->has('added-to-cart'))
        @php
            $cart_item = session()->get('added-to-cart')
        @endphp
        <div class="container">
            <div x-data="{open: true}" x-show="open"
                 class="relative my-5 py-8 px-6 rounded-md bg-e8faed ring-1 ring-b5eac4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative grid place-items-center h-28 w-auto aspect-video rounded-md bg-ffa368 overflow-hidden">
                            <x-heroicon-o-gift class="h-24 w-24 text-fff4ed"/>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-sm font-semibold text-0d171a">{{ __('Gift Card') }}</h3>
                            <p class="text-sm text-0d171a">
                                {{ __('Valore:') }}
                                <span class="font-semibold">{{ money($cart_item->gift_card->value, forceDecimals: true) }}</span>
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
        </div>
    @endif
    <div class="relative lg:h-[570px]">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1628336707384-714fa3a5cbde?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt=""
                class="w-full h-full object-cover"
            >
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-0d171a/70 via-0d171a/20 via-40%"></div>
        <div class="relative z-[5] flex flex-col w-full pt-20 pb-10 text-center h-full lg:pt-0 lg:pb-7 lg:justify-end">
            <div class="mt-12 text-white font-semibold">
                <h3 class="text-3xl lg:text-5xl">{{ __('Buoni Regalo') }}</h3>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="container space-y-6 2xl:px-0">
            <div>
                <h3 class="font-semibold text-ffa368 text-xl lg:border-b lg:border-b-e2eaeb pb-3 lg:mb-5 2xl:px-0">{{ __('Scegli il regalo giusto') }}</h3>
                <p class="text-sm text-0d171a">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias aperiam consequuntur doloribus eos exercitationem fuga id ipsa, iste iure magni maiores nobis optio perferendis quaerat reiciendis voluptates? Minus, possimus.
                </p>
            </div>
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-wrap justify-center xl:justify-start gap-6">
                    @foreach($gift_cards as $gift_card)
                        <livewire:common.gift-card :gift_card="$gift_card"/>
                    @endforeach
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
