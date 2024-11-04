<header x-cloak x-data="{open: false}" class="relative z-20 bg-white shadow-sm">
    <nav
        class="container flex items-center justify-between py-3 lg:static">
        <div class="flex lg:flex-1">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="h-14 w-auto" colored></x-application-logo>
            </a>
        </div>
        <div class="flex lg:hidden">
            <button x-on:click="open = true" type="button"
                    class="{{ request()->route()->getName() === 'guest.index' ? 'text-white' : 'text-0d171a' }} -m-2.5 inline-flex items-center justify-center rounded-md p-2.5">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <x-dropdown align="right">
                <x-slot:trigger>
                    <button type="button"
                            class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0"
                            aria-expanded="false">
                        {{ __('Le mie attività') }}
                        <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </x-slot:trigger>
                <x-slot:content>
                    <x-dropdown-link href="{{ route('product.index') }}">{{ __('Le mie attività') }}</x-dropdown-link>
                    <x-dropdown-link href="{{ route('product.init.create') }}">{{ __('Crea nuova') }}</x-dropdown-link>
                </x-slot:content>
            </x-dropdown>
            <x-dropdown align="right">
                <x-slot:trigger>
                    <button type="button"
                            class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0"
                            aria-expanded="false">
                        {{ __('Gestione') }}
                        <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </x-slot:trigger>
                <x-slot:content>
                    <x-dropdown-link href="{{ route('bookings.management.index') }}">{{ __('Gestione prenotazioni') }}</x-dropdown-link>
                    <x-dropdown-link href="{{ route('availabilities.index') }}">{{ __('Disponibilità') }}</x-dropdown-link>
                    <x-dropdown-link href="{{ route('specials.index') }}">{{ __('Offerte speciali') }}</x-dropdown-link>
                    <x-dropdown-link href="{{ route('coupons.index') }}">{{ __('Coupons') }}</x-dropdown-link>
                </x-slot:content>
            </x-dropdown>
            <x-dropdown align="right">
                <x-slot:trigger>
                    <button type="button"
                            class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0"
                            aria-expanded="false">
                        {{ __('Prenotazioni') }}
                        <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </x-slot:trigger>
                <x-slot:content>
                    <x-dropdown-link href="{{ route('bookings.history') }}">{{ __('Elenco prenotazioni') }}</x-dropdown-link>
                    <x-dropdown-link href="{{ route('bookings.scanner') }}">{{ __('Scanner di biglietti') }}</x-dropdown-link>
                </x-slot:content>
            </x-dropdown>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->fullname }}"/>
                        </button>
                    @else
                        <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0">
                                        {{ Auth::user()->fullname }}
                                        <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0"
                                             viewBox="0 0 20 20"
                                             fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                    @endif
                </x-slot>

                <x-slot name="content">
                    @hasanyrole('partner|administrator')
                    <x-dropdown-link href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('partner.profile.show') }}">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    @endhasanyrole
                    @hasrole('client')
                    <x-dropdown-link href="{{ route('guest.profile.show') }}">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    @endhasrole

                    <div class="border-t border-gray-200"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a href="#"
               class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0">
                {{ __('Aiuto') }}
            </a>
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div x-show="open" class="fixed inset-0 z-10"></div>
        <div x-show="open"
             class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-end">
                <button x-on:click="open = false" type="button" class="relative -m-2 top-3 rounded-md text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y">
                    <div class="space-y-2 py-6 text-left">
                        <a href="{{ route('guest.index') }}" class="block py-6">
                            <x-application-logo class="h-20 w-auto mx-auto" colored></x-application-logo>
                        </a>
                        <div class="flex flex-col gap-y-8">
                            <div x-data="{open: false}" class="relative w-full">
                                <button x-on:click="open = true" type="button"
                                        class="group flex items-center justify-between w-full gap-x-1 font-semibold leading-6 text-0d171a mx-auto hover:text-00abc0"
                                        aria-expanded="false">
                                    <span>{{ __('Le mie attività') }}</span>
                                    <svg class="h-5 w-5 flex-none text-0d171a group-hover:text-00abc0"
                                         :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div x-show="open"
                                     x-on:click.outside="open = false"
                                     class="mt-3 overflow-hidden rounded-sm bg-white">
                                    <div class="px-4 space-y-4">
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Le mie attività') }}
                                        </a>
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Crea nuova') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{open: false}" class="relative w-full">
                                <button x-on:click="open = true" type="button"
                                        class="group flex items-center justify-between w-full gap-x-1 font-semibold leading-6 text-0d171a mx-auto hover:text-00abc0"
                                        aria-expanded="false">
                                    <span>{{ __('Gestione') }}</span>
                                    <svg class="h-5 w-5 flex-none text-0d171a group-hover:text-00abc0"
                                         :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div x-show="open"
                                     x-on:click.outside="open = false"
                                     class="mt-3 overflow-hidden rounded-sm bg-white">
                                    <div class="px-4 space-y-4">
                                        <a href="{{ route('bookings.management.index') }}" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Gestione prenotazioni') }}
                                        </a>
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Disponibilità') }}
                                        </a>
                                        <a href="{{ route('specials.index') }}" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Offerte speciali') }}
                                        </a>
                                        <a href="{{ route('coupons.index') }}" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Coupons') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{open: false}" class="relative w-full">
                                <button x-on:click="open = true" type="button"
                                        class="group flex items-center justify-between w-full gap-x-1 font-semibold leading-6 text-0d171a mx-auto hover:text-00abc0"
                                        aria-expanded="false">
                                    <span>{{ __('Prenotazioni') }}</span>
                                    <svg class="h-5 w-5 flex-none text-0d171a group-hover:text-00abc0"
                                         :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div x-show="open"
                                     x-on:click.outside="open = false"
                                     class="mt-3 overflow-hidden rounded-sm bg-white">
                                    <div class="px-4 space-y-4">
                                        <a href="{{ route('bookings.history') }}" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Elenco prenotazioni') }}
                                        </a>
                                        <a href="{{ route('bookings.scanner') }}" class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Scanner di biglietti') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div x-data="{open: false}" class="relative w-full">
                                <button x-on:click="open = true" type="button"
                                        class="group flex items-center justify-between w-full gap-x-1 font-semibold leading-6 text-0d171a mx-auto hover:text-00abc0"
                                        aria-expanded="false">
                                    <span>{{ Auth::user()->fullname }}</span>
                                    <svg class="h-5 w-5 flex-none text-0d171a group-hover:text-00abc0"
                                         :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div x-show="open"
                                     x-on:click.outside="open = false"
                                     class="mt-3 overflow-hidden rounded-sm bg-white">
                                    <div class="px-4 space-y-4">
                                        @hasanyrole('partner|administrator')
                                        <a href="{{ route('dashboard') }}"
                                           class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Dashboard') }}
                                        </a>
                                        <a href="{{ route('partner.profile.show') }}"
                                           class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Profilo') }}
                                        </a>
                                        @endhasanyrole
                                        @hasrole('client')
                                        <a href="{{ route('guest.profile.show') }}"
                                           class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Profilo') }}
                                        </a>
                                        @endhasrole
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <a href="{{ route('logout') }}"
                                               @click.prevent="$root.submit();"
                                               class="block font-medium text-sm text-0d171a hover:text-00abc0"
                                            >
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
