<div>
    <livewire:components.hero/>
    <div class="flex flex-col">
        {{-- Le migliori esperienze selezionate per te --}}
        <div class="mt-8 bg-white order-2 lg:order-1 xl:mt-14 2xl:container">
            <div class="container 2xl:px-0">
                <h3 class="font-semibold text-0d171a text-xl lg:border-b lg:border-b-e2eaeb pb-3 lg:mb-9 2xl:px-0">{{ __('Le migliori esperienze selezionate per te') }}</h3>
            </div>
            <x-splide type="slide" :arrows="false" :pagination="false"
                      :breakpoints="[0 => ['padding' => '1rem', 'gap' => '1rem'], 1538 => ['padding' => '0rem', 'gap' => '0.75rem']]">
                @foreach([1,2,3,4,5] as $n)
                    <x-splide-slide wire:key="{{ $loop->index }}">
                        <x-simple-card
                            :image="fake()->imageUrl()"
                            :title="fake()->word()"
                            :activities="fake()->numberBetween(1, 7)">
                            <x-card-metadata color="bg-ffbb7c" count="7" activity="attività">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                </x-slot:icon>
                            </x-card-metadata>
                        </x-simple-card>
                    </x-splide-slide>
                @endforeach
            </x-splide>
        </div>

        {{-- Principali destinazioni --}}
        <div class="mt-8 bg-white order-3 lg:order-2 xl:mt-14 2xl:container">
            <div class="container 2xl:px-0">
                <h3 class="font-semibold text-0d171a text-xl lg:border-b lg:border-b-e2eaeb pb-3 lg:mb-9 2xl:px-0">{{ __('Principali destinazioni') }}</h3>
            </div>
            <x-splide type="slide" :arrows="false" :pagination="false"
                      :breakpoints="[0 => ['padding' => '1rem', 'gap' => '1rem'], 1538 => ['padding' => '0rem', 'gap' => '1rem']]">
                @foreach([1,2,3,4] as $n)
                    <x-splide-slide wire:key="{{ $loop->index }}">
                        <x-destination-card
                            :image="fake()->imageUrl()"
                            title="Bosa, Alghero e Grotte di Nettuno"
                        >
                            <x-card-metadata color="bg-ffbb7c" count="5" activity="attrazioni culturali">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                </x-slot:icon>
                            </x-card-metadata>
                            <x-card-metadata color="bg-ff7968" count="13" activity="ristoranti">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                </x-slot:icon>
                            </x-card-metadata>
                            <x-card-metadata color="bg-006cbc" count="7" activity="noleggio barche">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                </x-slot:icon>
                            </x-card-metadata>
                        </x-destination-card>
                    </x-splide-slide>
                @endforeach
            </x-splide>
        </div>

        {{-- Noleggio --}}
        <div
            class="-translate-y-3 pt-3 bg-0d171a rounded-t-xl order-1 lg:order-3 lg:rounded-t-none lg:mt-9 xl:pt-0 xl:mt-20 xl:pb-8 xl:translate-y-0">
            <div class="container">
                <h3 class="font-semibold text-white text-xl lg:border-b lg:border-b-e2eaeb lg:pb-3 lg:mb-9 lg:pt-6 lg:px-0 xl:pt-0 xl:mt-14">{{ __('Noleggio') }}</h3>
            </div>
            <div x-id="['splide']" class="2xl:container grid grid-cols-12 gap-3 my-4">
                <div class="col-span-3 hidden xl:block ml-4 2xl:ml-0">
                    <img
                        src="{{fake()->imageUrl()}}"
                        alt=""
                        class="h-[490px] rounded-md object-cover"
                    >
                    <div class="flex items-center justify-center pt-7 pb-4">
                        <div class="space-x-4">
                            <button x-on:click="$dispatch('prev_' + $id('splide'))"
                                    class="splide__arrow--prev bg-1e2e33 text-white p-2 rounded-full hover:bg-white/20"
                                    type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="!fill-none w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                </svg>
                            </button>
                            <button x-on:click="$dispatch('next_' + $id('splide'))"
                                    class="splide__arrow--next bg-1e2e33 text-white p-2 rounded-full hover:bg-white/20"
                                    type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="!fill-none w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-9">
                    <x-splide type="slide" :arrows="false" :pagination="false">
                        @foreach([1,2,3,4,5] as $n)
                            <x-splide-slide class="w-[354px]">
                                <livewire:common.product-card
                                    wire:key="{{ $loop->index }}"
                                    :product="\App\Models\Product::first()"
                                />
                            </x-splide-slide>
                        @endforeach
                    </x-splide>
                </div>
            </div>
            <div class=" text-center my-7 xl:hidden">
                <x-tripsy-button color="orange">{{ __('Vedi tutto') }}</x-tripsy-button>
            </div>
        </div>

        {{-- Attività da non perdere --}}
        <div class="mt-8 bg-white order-4 lg:order-4 lg:pb-8 xl:mt-14 2xl:container">
            <div class="container 2xl:px-0">
                <h3 class="font-semibold text-0d171a text-xl lg:border-b lg:border-b-e2eaeb pb-3 lg:mb-9 2xl:px-0">{{ __('Attività da non perdere') }}</h3>
            </div>
            <div class="my-4 xl:my-0">
                <x-splide type="slide" :arrows="false" :pagination="false"
                          :breakpoints="[0 => ['padding' => '1rem', 'gap' => '1rem'], 1538 => ['padding' => '0rem', 'gap' => '1.5rem']]">
                    @foreach([1,2,3,4,5] as $n)
                        <x-splide-slide class="w-[354px]">
                            <livewire:common.product-card
                                wire:key="{{ $loop->index }}"
                                :product="\App\Models\Product::find(1)"
                                theme="light"
                            />
                        </x-splide-slide>
                    @endforeach
                </x-splide>
            </div>
        </div>

        {{-- Regala un momento magico --}}
        <div class="mt-8 bg-fafcfc order-4 lg:order-4 xl:mt-0">
            <div class="relative h-[264px] lg:hidden">
                <img
                    src="https://plus.unsplash.com/premium_photo-1684917945225-79990f098a53?q=80&w=3869&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt=""
                    class="w-full object-cover h-[264px]"
                >
            </div>
            <div
                class="-translate-y-3 pt-3.5 bg-fafcfc rounded-t-xl order-1 lg:order-3 lg:rounded-t-none lg:translate-y-0">
                <div class="text-center">
                    <h3 class="font-semibold text-00abc0 text-xl lg:py-8">{{ __('Regala un momento magico') }}</h3>
                </div>
                <div class="hidden lg:block lg:container">
                    <img
                        src="https://plus.unsplash.com/premium_photo-1684917945225-79990f098a53?q=80&w=3869&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt=""
                        class="w-full object-cover h-[437px]"
                    >
                </div>
                <div>
                    <div class="lg:container">
                        <div class="flex justify-center">
                            <div
                                class="flex items-center space-x-2 px-3 mx-auto h-14 mt-7 overflow-x-scroll no-scrollbar lg:mx-auto lg:max-w-4xl lg:space-x-5">
                            <span
                                class="inline-flex items-center rounded-full bg-fafcfc px-7 py-2 text-xs font-medium border border-e2eaeb text-b0b7be shrink-0 hover:cursor-pointer hover:border-00abc0 hover:text-00abc0">Enogastronomia</span>
                                <span
                                    class="inline-flex items-center rounded-full bg-fafcfc px-7 py-2 text-xs font-medium border border-e2eaeb text-b0b7be shrink-0 hover:cursor-pointer hover:border-00abc0 hover:text-00abc0">Escursioni</span>
                                <span
                                    class="inline-flex items-center rounded-full bg-fafcfc px-7 py-2 text-xs font-medium border border-e2eaeb text-b0b7be shrink-0 hover:cursor-pointer hover:border-00abc0 hover:text-00abc0">Barca</span>
                                <span
                                    class="inline-flex items-center rounded-full bg-fafcfc px-7 py-2 text-xs font-medium border border-e2eaeb text-b0b7be shrink-0 hover:cursor-pointer hover:border-00abc0 hover:text-00abc0">Montagna</span>
                                <span
                                    class="inline-flex items-center rounded-full bg-fafcfc px-7 py-2 text-xs font-medium border border-e2eaeb text-b0b7be shrink-0 hover:cursor-pointer hover:border-00abc0 hover:text-00abc0">Arte e Cultura</span>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-y-3 gap-x-12 mt-4 lg:mx-auto lg:max-w-5xl">
                            @foreach([1,2,3,4,5,6] as $n)
                                <div
                                    wire:key="{{ $loop->index }}"
                                    class="flex space-x-5 col-span-1 bg-transparent rounded-md p-3 transition-all hover:cursor-pointer hover:bg-white hover:shadow-lg hover:shadow-0d171a/5">
                                    <div class="w-14 h-14 rounded-md shrink-0 overflow-hidden">
                                        <img
                                            src="{{fake()->imageUrl()}}"
                                            alt=""
                                            class="object-cover w-full h-full"
                                        >
                                    </div>
                                    <div class="flex flex-col w-full space-y-2 5">
                                        <h5 class="text-0d171a font-semibold">{{ fake()->word() }}</h5>
                                        <div class="flex items-center space-x-1 text-sm text-627277">
                                            <span>{{ __('A partire da') }}</span>
                                            <span class="text-0d171a font-semibold">{{ money(0, forceDecimals: true) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center my-7">
                        <x-tripsy-button color="orange">{{ __('Vedi tutto') }}</x-tripsy-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
