<div>
    <div class="py-6 bg-white lg:py-10 lg:bg-fafcfc">
        <div
            wire:click="$dispatch('openModal', { component: 'common.modals.set-trip-data-modal', arguments: { destination: {{ $selectedDestination['id'] ?? 'null' }}, category: {{ $selectedCategory['id'] ?? 'null' }}, participant: {{ $participant ?? 'null' }}, date: '{{ $date }}' }})"
            class="relative h-14 mx-auto w-full max-w-sm ring-1 ring-e2eaeb bg-white rounded-full flex items-center space-x-2.5 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 ml-4 text-ffbb7c">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
            </svg>
            <div class="flex flex-col">
                <span
                    class="text-sm font-semibold text-0d171a">{{ $selectedDestination['value'] ?? __('Dove vuoi andare?') }}</span>
                <div class="flex divide-x divide-e2eaeb text-xs text-627277">
                    @if($selectedCategory)
                        <span class="px-1 first:pl-0 last:pr-0">{{ $selectedCategory['value'] }}</span>
                    @endif
                    @if($participant)
                        <span
                            class="px-1 first:pl-0 last:pr-0">{{ trans_choice('{1} :count persona|[2,*] :count persone', $participant) }}</span>
                    @endif
                    @if($date)
                        <span
                            class="px-1 first:pl-0 last:pr-0">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</span>
                    @endif
                </div>
            </div>
            <div wire:click.stop="geolocation" class="absolute right-4 text-00abc0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                </svg>
            </div>
        </div>
        <form wire:submit="search" class="container hidden flex-col items-start space-y-6 lg:flex">
            <x-tripsy-select label="{{ __('Destinazione') }}" :inline="true" class="w-full">
                <x-slot:title>
                    {{ $selectedDestination['value'] ?? __('Destinazione') }}
                </x-slot:title>
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                </x-slot:icon>
                <x-slot:prepend>
                    <x-tripsy-button
                        wire:click.stop="geolocation"
                        class="!px-3 !py-1.5 space-x-1 ring-1 ring-00abc0 text-00abc0 !font-medium hover:bg-defbff ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 group-hover:text-00abc0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                        </svg>
                        <span class="group-hover:text-00abc0">{{ __('Vicino a me') }}</span>
                    </x-tripsy-button>
                </x-slot:prepend>
                <x-slot:content>
                    @foreach($destinations as $k => $item)
                        <li wire:key="destination-{{$k}}"
                            wire:click="setDestination('{{$item['id']}}', '{{$item['value']}}')"
                            class="{{ isset($selectedDestination['id']) && $selectedDestination['id'] == $item['id'] ? 'text-ffa14a' : '' }}"
                        >
                            {{ $item['value'] }}
                        </li>
                    @endforeach
                </x-slot:content>
            </x-tripsy-select>
            <div
                class="mx-auto w-full mt-9 space-y-2.5">
                <div
                    class="flex items-center justify-between px-1.5 bg-white border border-e2eaeb rounded-full h-14 w-full">
                    <div class="flex w-full pl-2.5">
                        <div class="flex flex-1 items-center justify-start h-8">
                            <x-tripsy-select wire:key="category" wire:model="selectedCategory" :inline="true"
                                             label="{{ __('Attività') }}" class="border-none !bg-transparent !px-0">
                                <x-slot:title>
                                    {{ $selectedCategory['value'] ?? __('Tipologia Servizio') }}
                                </x-slot:title>
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                    </svg>
                                </x-slot:icon>
                                <x-slot:content>
                                    @foreach($categories as $k => $item)
                                        <li wire:key="category-{{$k}}"
                                            wire:click="setCategory('{{$item['id']}}', '{{$item['value']}}')"
                                            class="{{ isset($selectedCategory['id']) && $selectedCategory['id'] == $item['id'] ? 'text-ffa14a' : '' }}"
                                        >
                                            {{ $item['value'] }}
                                        </li>
                                    @endforeach
                                </x-slot:content>
                            </x-tripsy-select>
                        </div>
                        <hr class="w-px h-8 border-0 bg-e2eaeb">
                        <div class="flex flex-1 items-center justify-start h-8 pl-3">
                            <x-tripsy-select wire:key="participant" wire:model="participant" inline
                                             label="{{ __('N. Persone') }}" class="border-none !bg-transparent !px-0">
                                <x-slot:title>
                                    {{ $participant ? trans_choice('{1} :count persona|[2,*] :count persone', $participant) : __('Persone') }}
                                </x-slot:title>
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                    </svg>
                                </x-slot:icon>
                                <x-slot:content>
                                    @foreach($participants as $k => $participant)
                                        <li wire:key="participant-{{$k}}"
                                            wire:click="$set('participant', '{{ $participant }}')"
                                            class="{{ $participant == $item['id'] ? 'text-ffa14a' : '' }}"
                                        >
                                            {{ $participant }}
                                        </li>
                                    @endforeach
                                </x-slot:content>
                            </x-tripsy-select>
                        </div>
                        <hr class="w-px h-8 border-0 bg-e2eaeb">
                        <div class="flex flex-1 items-center justify-start h-8">
                            <x-datepicker wire:model.live="date" class="!ring-0 !bg-transparent" autoclose
                                          label="{{ __('Data') }}">
                                <x-slot:title>
                                    {{ __('Quando') }}
                                </x-slot:title>
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                                    </svg>
                                </x-slot:icon>
                            </x-datepicker>
                        </div>
                    </div>
                    <x-tripsy-button color="orange" type="submit" class="space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 group-hover:text-00abc0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                        <span class="group-hover:text-00abc0">{{ __('Cerca') }}</span>
                    </x-tripsy-button>
                </div>
            </div>
        </form>
    </div>
    <div class="container pt-0 pb-10 lg:pt-10">
        {{-- Empty state --}}
        @if($products->count())
            <h3 class="text-xl pb-3 border-b border-e2eaeb lg:text-2xl">
                @if($destinationValue)
                    <span class="font-bold text-ffbb7c capitalize">{{ $destinationValue }}:</span>
                @endif
                <span class="text-1e2e33">{{ __('tutte le attività') }}</span>
            </h3>
            <div
                class="flex flex-col items-start py-6 space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                <span
                    class="text-sm text-b0b7be">{{ trans_choice('{1} :count attività trovata|[2,*] :count attività trovate', $products->count()) }}</span>
                <div class="flex items-center space-x-2 w-full sm:w-auto">
                    <x-tripsy-button color="gray" class="space-x-2">
                        <span>{{ __('Ordina per') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </x-tripsy-button>
                    <x-tripsy-button color="black" class="flex-1 space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
                        </svg>
                        <span>{{ __('Filtra') }}</span>
                    </x-tripsy-button>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10">
                @foreach($products as $n)
                    <div class="col-span-1">
                        <a href="{{ route('guest.product.show', [$n->destination->slug, $n->slug]) }}">
                            <livewire:common.product-card
                                wire:key="{{ $loop->index }}"
                                :product="$n"
                                theme="light"
                            />
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-0d171a">
                {{ __('Nessun risultato trovato') }}
            </p>
        @endif
    </div>
</div>
