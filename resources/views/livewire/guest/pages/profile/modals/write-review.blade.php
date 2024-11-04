<div class="p-4">
    <h3 class="text-xl text-ffbb7c text-center font-semibold">{{ __('Scrivi una recensione') }}</h3>
    <div class="mt-8 space-y-6">
        <div class="flex items-start space-x-4">
            <div class="relative w-36 h-[95px] rounded-md overflow-hidden shrink-0">
                <img src="{{ Storage::url($product->main_image->path)}}"
                     class="absolute w-full h-full inset-0 object-cover"
                     alt="">
            </div>
            <div class="flex items-center w-full min-h-[100px] justify-between">
                <div class="flex-1 space-y-2">
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
                            class="truncate">{{ $product->destination->name }}</span>
                    </div>
                    <span
                        class="block text-0d171a font-semibold text-sm">{{ $product->name }}</span>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <x-input wire:model="title" label="{{ __('Titolo') }}"/>
            <x-textarea wire:model="content" label="{{ __('Recensione') }}"/>

            <div>
                <x-label>{{ __('Valutazione') }}</x-label>
                <div x-data="{ hoverRating: 0, rating: @entangle('rating') }" class="flex space-x-1 mt-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <x-heroicon-o-star
                            class="w-5 h-5 shrink-0 fill-current hover:cursor-pointer"
                            x-bind:class="{
                                    'text-yellow-500': hoverRating >= {{ $i }} || rating >= {{ $i }},
                                    'text-gray-300': hoverRating < {{ $i }} && rating < {{ $i }}
                                }"
                            @mouseover="hoverRating = {{ $i }}"
                            @mouseleave="hoverRating = 0"
                            @click="rating = {{ $i }}; $wire.$set('rating', {{ $i }})"
                        />
                    @endfor
                </div>
                <x-input-error for="rating"></x-input-error>
            </div>

            <div class="flex items-center justify-end mt-8">
                <div class="space-x-3">
                    <x-tripsy-button wire:click="$dispatch('closeModal')" color="gray">
                        {{ __('Annulla') }}
                    </x-tripsy-button>
                    <x-tripsy-button wire:click="submit" color="orange">
                        {{ __('Salva') }}
                    </x-tripsy-button>
                </div>
            </div>
        </div>
    </div>
</div>
