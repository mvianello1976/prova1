<div class="relative h-[calc(100vh_-_68px)] lg:h-[570px]">
    <div class="absolute inset-0">
        <img
            src="https://plus.unsplash.com/premium_photo-1684917945225-79990f098a53?q=80&w=3869&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt=""
            class="w-full h-full object-cover"
        >
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-0d171a/70 via-0d171a/20 via-40%"></div>
    <div class="relative z-[5] flex flex-col w-full pt-20 text-center h-full lg:pt-0 lg:pb-7 lg:justify-end">
        <div class="mt-12 text-white font-semibold">
            <h3 class="text-2xl lg:text-5xl">{{ __('Vivi momenti indimenticabili') }}</h3>
            <p class="lg:text-2xl">{!! __('Prenota tour e attività a prezzi esclusivi in <span class="text-ffbb7c">Sardegna</span>') !!}</p>
        </div>
        <div wire:click="$dispatch('openModal', { component: 'common.modals.set-trip-data-modal' })"
             class="mt-5 h-14 mx-auto w-full max-w-sm bg-white rounded-full flex items-center space-x-2.5 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 ml-4 text-ffbb7c">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
            </svg>
            <span class="text-sm font-semibold text-0d171a">{{ __('Dove vuoi andare?') }}</span>
        </div>
        <div class="absolute bottom-6 flex flex-col items-center space-y-1 w-full text-white lg:hidden">
            <span class="text-sm">{{ __('Scopri di più') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            </svg>
        </div>
        <div
            class="hidden flex-col items-start p-4 pb-3 bg-fafcfc rounded mx-auto w-full max-w-3xl mt-9 space-y-2.5 lg:flex">
            <h3 class="text-00abc0 font-semibold text-sm uppercase">{{ __('Ricerca una destinazione, attrazione o esperienza:') }}</h3>
            <form wire:submit="search"
                  class="flex items-center justify-between px-1.5 bg-white border border-e2eaeb rounded-full h-14 w-full">
                <div class="flex w-full pl-2.5">
                    <div class="flex flex-1 items-center justify-start h-8">
                        <x-tripsy-select wire:key="destination" wire:model="selectedDestination" :inline="true"
                                         class="border-none !bg-transparent !px-0">
                            <x-slot:title>
                                {{ $selectedDestination['value'] ?? __('Destinazione') }}
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
                                <li wire:click="geolocation" class="group flex items-center justify-center space-x-1 rounded-full py-1.5 border border-00abc0 font-medium text-00abc0 hover:bg-defbff">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="w-4 h-4 group-hover:text-00abc0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                    </svg>
                                    <span class="group-hover:text-00abc0">{{ __('Vicino a me') }}</span>
                                </li>
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
                    </div>
                    <hr class="w-px h-8 border-0 bg-e2eaeb">
                    <div class="flex flex-1 items-center justify-start h-8">
                        <x-datepicker wire:model.live="date" class="!ring-0 !bg-transparent" autoclose>
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
                <x-tripsy-button type="submit"
                                 color="orange"
                                 :disabled="!$selectedDestination || !$date"
                                 class="grid place-items-center !p-0 w-11 h-11 rounded-full shrink-0"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                </x-tripsy-button>
            </form>
        </div>
    </div>
</div>
