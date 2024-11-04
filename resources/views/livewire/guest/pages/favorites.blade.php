<div class="container">
    <h1 class="text-2xl font-bold text-1e2e33 py-5">{{ __('I tuoi preferiti') }}</h1>
    @if(auth()->user()->favorites->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10">
            @foreach(auth()->user()->favorites as $n)
                <div class="col-span-1" wire:key="{{ $n->id }}">
                    <a href="{{ route('guest.product.show', [$n->destination->slug, $n->slug]) }}">
                        <livewire:common.product-card
                            :key="$n->id"
                            :product="$n"
                            theme="light"
                        />
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-sm text-0d171a pb-5">
            {{ __('Nessun preferito trovato') }}
        </p>
    @endif
</div>
