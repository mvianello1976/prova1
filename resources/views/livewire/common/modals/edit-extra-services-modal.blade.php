<div class="p-4">
    <div class="text-center space-y-4">
        <h3 class="text-xl text-0d171a font-semibold">{{ __('Servizi aggiuntivi') }}</h3>
        <p class="text-sm text-0d171a">{{ __('Vuoi aggiungere alcuni servizi aggiuntivi alla tua esperienza?') }}</p>
    </div>
    <div class="mt-8 divide-y divide-e2eaeb">
        @foreach($product->extra_services as $extra_service)
            <div class="flex items-center justify-between py-2">
                <div>
                    <h5 class="text-sm text-0d171a">{{ $extra_service->name }} - {{ money($extra_service->price, forceDecimals: true) }}</h5>
                    <p class="text-xs text-627277">{!! $extra_service->description !!}</p>
                </div>
                @if(!in_array($extra_service->id, $services))
                    <x-tripsy-button
                        wire:click="addService({{$extra_service->id}})"
                        color="lightblue"
                        class="!px-3 !py-1 !text-xs !rounded-sm space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        <span>{{ __('Aggiungi') }}</span>
                    </x-tripsy-button>
                @else
                    <x-tripsy-button
                        wire:click="removeService({{$extra_service->id}})"
                        color="green"
                        class="!px-3 !py-1 !text-xs !rounded-sm space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span>{{ __('Aggiunto') }}</span>
                    </x-tripsy-button>
                @endif
            </div>
        @endforeach
    </div>
    <div class="flex items-center justify-end mt-8">
        <div class="space-x-3">
            <x-tripsy-button wire:click="$dispatch('closeModal')" color="gray">{{ __('Annulla') }}</x-tripsy-button>
            <x-tripsy-button wire:click="confirm" color="orange">
                @if(count($services) > 0)
                    {{ __('Conferma') }}
                @else
                    {{ __('Continua') }}
                @endif
            </x-tripsy-button>
        </div>
    </div>
</div>
