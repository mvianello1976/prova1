<a href="{{ route('guest.product.show', ['destination' => $product->destination->slug, 'product' => $product->slug]) }}"
   class="group relative flex flex-col transition-all border {{$theme === 'dark' ? 'border-627277 hover:border-1e2e33' : 'border-eff4f5 hover:shadow-lg' }} p-2 min-w-64 min-h-[480px] rounded-md overflow-hidden xl:w-full xl:h-[573px]">
    <div class="rounded-t-md overflow-hidden">
        <img
            src="{{ Storage::url($product->main_image->path) }}"
            alt=""
            class="transition-transform group-hover:scale-110"
        >
    </div>
    @auth
        <div
            wire:click.prevent="toggleFavorite"
            class="group/favorite absolute top-5 right-5 grid place-items-center p-2 ring-1 ring-white bg-white rounded-full hover:cursor-pointer">
            <x-heroicon-o-heart class="w-5 h-5 stroke-2 {{ $isFavorited ? 'fill-red-500 stroke-red-500' : 'fill-white stroke-gray-400 group-hover/favorite:stroke-red-500' }}"/>
        </div>
    @endauth
    {{--    @if($recommended)--}}
    {{--        <div--}}
    {{--            class="absolute top-5 left-5 grid place-items-center py-1.5 px-4 ring-1 ring-white bg-006cbc text-xs text-white font-medium rounded-full">--}}
    {{--            {{ __('Consigliato') }}--}}
    {{--        </div>--}}
    {{--    @endif--}}
    @if($product->isInSpecialOffer(session('date')))
        <div
            class="absolute top-5 left-5 grid place-items-center py-1.5 px-4 ring-1 ring-inset ring-blue-700/10 bg-blue-50 text-xs text-blue-700 font-semibold uppercase rounded-full">
            {{ __('In Offerta') }}
        </div>
    @endif
    <div class="mt-3 space-y-3 flex-1">
        <h5 class="flex items-center space-x-1 text-xs text-00abc0 font-semibold uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>
            <span class="truncate">{{ $product->destination->name }}</span>
        </h5>
        <h4 class="{{ $theme === 'dark' ? 'text-white' : 'text-0d171a' }} font-semibold text-xl">{{ $product->name }}</h4>
        <p class="{{ $theme === 'dark' ? 'text-white' : 'text-0d171a' }} text-xs leading-5 line-clamp-3">{{ $product->description }}</p>
        @if($capacity)
            <span
                class="{{ $theme === 'dark' ? 'text-white' : 'text-0d171a' }} text-sm font-semibold">Max {{ trans_choice('{1} :count persona|[2,*] :count persone', $capacity) }}</span>
        @endif
    </div>
    <div
        class="flex items-center justify-between min-w-64 -mx-2 p-2 pb-0 xl:pb-2 self-stretch border-t {{ $theme === 'dark' ? 'border-627277 group-hover:border-1e2e33' : 'border-eff4f5' }} xl:w-full xl:mx-0">
        <div class="flex items-center space-x-1 text-00abc0 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <span>{{ trans_choice('{1} :count ora|[2,*] :count ore', $product->duration) }}</span>
        </div>
        <div class="flex items-center space-x-1 text-sm {{ $theme === 'dark' ? 'text-b0b7be' : 'text-627277' }}">
            <span>{{ __('A partire da') }}</span>
            <span class="{{ $theme === 'dark' ? 'text-white' : 'text-0d171a' }} font-semibold">{{ money($product->base_price, forceDecimals: true) }}</span>
        </div>
    </div>
</a>
