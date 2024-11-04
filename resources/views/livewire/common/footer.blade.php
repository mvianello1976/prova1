<footer class="bg-0d171a pb-20 lg:pb-0">
    <div x-data="{openTab: null}" class="container">
        <div class="grid pt-8 lg:pt-16 lg:grid-cols-3 xl:gap-8">
            <div class="grid grid-cols-1 gap-8 mt-10 order-2 lg:mt-0 lg:grid-cols-3 lg:col-span-2 lg:order-1">
                <div>
                    <div x-on:click="openTab !== 'company' ? openTab = 'company' : openTab = null" class="flex items-center justify-between cursor-pointer lg:cursor-auto">
                        <h3 class="text-base font-semibold leading-6 text-white">{{ __('Azienda') }}</h3>
                        <svg class="h-5 w-5 flex-none text-white lg:hidden" :class="openTab === 'company' ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <ul :class="openTab === 'company' ? '' : 'hidden lg:block'" role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('Chi siamo') }}</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('Preferiti') }}</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('Lavora con noi') }}</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div x-on:click="openTab !== 'help_and_support' ? openTab = 'help_and_support' : openTab = null" class="flex items-center justify-between cursor-pointer lg:cursor-auto">
                        <h3 class="text-base font-semibold leading-6 text-white">{{ __('Help & Support') }}</h3>
                        <svg class="h-5 w-5 flex-none text-white lg:hidden" :class="openTab === 'help_and_support' ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <ul :class="openTab === 'help_and_support' ? '' : 'hidden lg:block'" role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('Come funziona') }}</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('Contattaci') }}</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('Assistenza') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="hidden lg:block">
                    <h3 class="text-base font-semibold leading-6 text-white">{{ __('Seguici su') }}</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Facebook</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Instagram</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mx-auto order-1 lg:order-2">
                <h3 class="text-xl font-semibold leading-6 text-white">{{ __('Lasciati Ispirare!') }}</h3>
                <p class="mt-2 text-sm leading-6 text-gray-300">{{ __('Iscriviti alla nostra newsletter per ottenere il meglio che Tripsy Tour ha da offrirti') }}</p>
                <form class="relative mt-6">
                    <div class="relative mt-2 w-full rounded-md shadow-sm">
                        <input type="email" name="email-address" id="email-address" autocomplete="email" required
                               class="w-full min-w-0 appearance-none rounded-full border-0 bg-white px-4 py-2 text-base shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 xl:w-full"
                               placeholder="{{ __('Il tuo indirizzo email') }}"/>
                        <div
                            class="absolute inset-y-0 top-0.5 right-1 flex items-center justify-center w-9 h-9 rounded-full shrink-0 bg-ffbb7c hover:bg-fdac61 hover:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-white -rotate-45">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </div>
                    </div>
                </form>
                <p class="mt-2.5 text-b0b7be text-xs">{{ __('Iscrivendoti, dichiari di accettare Termini e condizioni, Garanzie e Politiche sulla privacy') }}</p>
            </div>
        </div>
        <hr class="hidden h-px my-10 border-0 bg-627277 lg:block">
        <div class="grid pt-8 xl:grid-cols-2 xl:gap-8 lg:pt-0">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 xl:col-span-2">
                <div class="lg:max-w-md">
                    <div x-on:click="openTab !== 'most_desired_destinations' ? openTab = 'most_desired_destinations' : openTab = null" class="flex items-center justify-between cursor-pointer lg:cursor-auto">
                        <h3 class="text-base font-semibold leading-6 text-white">{{ __('Le mete più desiderate') }}</h3>
                        <svg class="h-5 w-5 flex-none text-white lg:hidden" :class="openTab === 'most_desired_destinations' ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <ul :class="openTab === 'most_desired_destinations' ? '' : 'hidden lg:grid'" role="list" class="mt-6 grid grid-rows-3 grid-cols-2 gap-4 grid-flow-col">
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Bosa</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Alghero</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Porto Cervo</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Golfo di Orsei</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Golfo Aranci</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Porto Torres</a>
                        </li>
                    </ul>
                </div>
                <div class="lg:max-w-md">
                    <div x-on:click="openTab !== 'most_requested_experiences' ? openTab = 'most_requested_experiences' : openTab = null" class="flex items-center justify-between cursor-pointer lg:cursor-auto">
                        <h3 class="text-base font-semibold leading-6 text-white">{{ __('Le esperienze più richieste') }}</h3>
                        <svg class="h-5 w-5 flex-none text-white lg:hidden" :class="openTab === 'most_requested_experiences' ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <ul :class="openTab === 'most_requested_experiences' ? '' : 'hidden lg:grid'" role="list" class="mt-6 grid grid-rows-3 grid-cols-2 gap-4 grid-flow-col">
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Noleggio</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Escursioni in barca</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Escursioni a cavallo</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Escursioni in bici e mountain bike</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Gita in montagna</a>
                        </li>
                        <li>
                            <a href="#"
                               class="text-sm leading-6 text-gray-300 hover:text-white">Enogastronomia</a>
                        </li>
                    </ul>
                </div>
                <div class="lg:hidden">
                    <div x-on:click="openTab !== 'follow_us' ? openTab = 'follow_us' : openTab = null" class="flex items-center justify-between cursor-pointer lg:cursor-auto">
                        <h3 class="text-base font-semibold leading-6 text-white">{{ __('Seguici su') }}</h3>
                        <svg class="h-5 w-5 flex-none text-white lg:hidden" :class="openTab === 'follow_us' ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <ul :class="openTab === 'follow_us' ? '' : 'hidden lg:block'" role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Facebook</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Instagram</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="h-px my-8 border-0 bg-627277">
        <div class="text-sm text-center space-y-2.5 pb-8">
            <p class="block text-white">TripsyTour S.r.l. P.IVA/C.F. 17152431007 - Circonvallazione Clodia 163/167, 00195 Roma</p>
            <div class="flex items-center justify-center divide-x divide-gray-300">
                <a href="#" class="text-gray-300 hover:text-white px-2">Privacy Policy</a>
                <a href="#" class="text-gray-300 hover:text-white px-2">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
