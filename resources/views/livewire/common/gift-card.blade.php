<div class="relative flex flex-col w-[400px] h-[220px] bg-fff4ed py-3 px-4 overflow-hidden rounded-xl">
    <div class="absolute bg-ffa368 inset-y-0 h-[607px] w-[670px] rounded-full -translate-x-[276px] -translate-y-96"></div>
    <x-heroicon-o-gift class="absolute right-16 bottom-7 h-32 w-32 text-fff4ed stroke-[0.5px]"/>
    <div class="flex flex-col gap-1.5 mt-2 z-10">
        <h3 class="text-xl text-fff4ed font-semibold">{{ __('Gift Card') }}</h3>
        <div class="flex items-center space-x-2 text-white">
            <x-heroicon-o-gift class="w-4 h-4"/>
            <span class="text-sm leading-none">{{ __('Valida 12 mesi') }}</span>
        </div>
    </div>
    <div class="mt-auto flex items-center justify-between z-10">
        <x-tripsy-button wire:click="addToCart" color="white" class="!px-6">
            {{ __('Aggiungi al carrello') }}
        </x-tripsy-button>
        <span class="text-[35px] leading-none font-semibold text-ffa368">{{ $gift_card->value }}€</span>
    </div>
</div>
