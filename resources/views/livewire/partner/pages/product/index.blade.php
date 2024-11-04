<div>
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="border rounded bg-white p-8">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Le mie attività') }}</h3>
            <div class="space-y-3">
                @foreach($published as $product)
                    <div class="border mt-8 rounded p-3 space-y-3">
                        <div class="relative flex space-x-3">
                            <div class="relative h-28 w-auto aspect-video rounded-md overflow-hidden border">
                                <img src="{{ Storage::url($product->mainImage?->path) }}" class="absolute w-full h-full inset-0 object-cover"
                                     alt="">
                                @if($product->trashed())
                                    <div class="absolute inset-0 bg-black/40"></div>
                                    <div class="absolute w-full bg-red-200 text-red-600 py-px text-xs text-center font-semibold rounded-lg top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 -rotate-[27deg]">
                                        {{ __('Attività eliminata') }}
                                    </div>
                                @endif
                            </div>
                            <h5 class="flex-1 text-sm text-1e2e33 font-semibold max-w-md">
                                {{ $product->name }}
                            </h5>
                            <div class="absolute right-0 top-0">
                                <div class="flex items-center space-x-1">
                                    @if(!$product->trashed())
                                        <a href="{{ route('product.create', $product->id) }}" class="bg-fff2e6 text-ffa14a py-1 px-1 rounded hover:text-white hover:bg-ffa14a">
                                            <x-heroicon-o-pencil class="w-4 h-4 shrink-0"/>
                                        </a>
                                    @endif
                                    @if($product->trashed())
                                        <div wire:click="restore({{ $product->id }})" wire:confirm="{{ __('Sei sicuro di voler ripristinare questa attività?') }}" class="bg-defbff text-006cbc py-1 px-1 rounded hover:cursor-pointer hover:text-white hover:bg-00abc0">
                                            <x-heroicon-o-arrow-path class="w-4 h-4"/>
                                        </div>
                                    @else
                                        <div wire:click="delete({{ $product->id }})" wire:confirm="{{ __('Sei sicuro di voler eliminare questa attività?') }}" class="bg-fff2e6 text-e57868 py-1 px-1 rounded hover:text-white hover:cursor-pointer hover:bg-e57868">
                                            <x-heroicon-o-trash class="w-4 h-4"/>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if(!$product->trashed())
                                <a href="{{ route('guest.product.show', [$product->destination->slug, $product->slug]) }}" class="absolute right-0 bottom-0 text-xs text-03b8ce font-semibold">{{ __('Vedi dettagli') }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('product.init.create') }}" class="flex items-center space-x-1 text-sm text-03b8ce font-semibold">
                    <x-heroicon-o-plus class="w-4 h-4"/>
                    <span>{{ __('Aggiungi attività') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
