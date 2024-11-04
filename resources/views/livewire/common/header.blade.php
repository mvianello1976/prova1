<header x-cloak x-data="{open: false}" class="relative z-20 bg-transparent md:bg-white shadow-sm">
    <nav
        class="{{ request()->route()->getName() === 'guest.index' ? 'fixed w-full' : '' }} container flex items-center justify-between py-3 lg:static">
        <a href="{{ route('guest.index') }}">
            <x-application-logo class="h-14 w-auto hidden lg:block" colored></x-application-logo>
            <x-application-logo class="h-14 w-auto block lg:hidden"
                                :colored="request()->route()->getName() !== 'guest.index'"></x-application-logo>
        </a>
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
        <div class="hidden lg:flex lg:gap-x-6 lg:items-center">
            <div class="lg:flex lg:gap-x-10 lg:items-center">
                <x-dropdown align="right">
                    <x-slot:trigger>
                        <button type="button"
                                class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0"
                                aria-expanded="false">
                            {{ __('Esperienze') }}
                            <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot:trigger>
                    <x-slot:content>
                        @foreach($categories as $category)
                            <x-dropdown-link href="{{ route('guest.search', ['category' => $category->slug]) }}">{{ $category->name }}</x-dropdown-link>
                        @endforeach
                    </x-slot:content>
                </x-dropdown>
                <x-dropdown align="right">
                    <x-slot:trigger>
                        <button type="button"
                                class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0"
                                aria-expanded="false">
                            {{ __('Destinazioni') }}
                            <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot:trigger>
                    <x-slot:content>
                        @foreach($destinations as $destination)
                            <x-dropdown-link href="{{ route('guest.search', ['destination' => $destination->slug]) }}">{{ $destination->name }}</x-dropdown-link>
                        @endforeach
                    </x-slot:content>
                </x-dropdown>
                <a href="{{ route('guest.gift-cards') }}"
                   class="text-sm font-semibold leading-6 text-0d171a whitespace-nowrap hover:text-00abc0 hover:cursor-pointer">{{ __('Buoni Regalo') }}</a>
                @guest
                    <div wire:click="$dispatch('openModal', {component: 'common.modals.auth.login'})"
                         class="text-sm font-semibold leading-6 text-ffa14a hover:text-ffbb7c hover:cursor-pointer">{{ __('Accedi') }}</div>
                @endguest
            </div>
            <div class="block w-px h-8 bg-e2eaeb"></div>
            <div class="lg:flex lg:gap-x-6 lg:items-center">
                @guest
                    <div wire:click="$dispatch('openModal', {component: 'common.modals.auth.register'})"
                         class="px-6 py-1 text-sm font-semibold leading-6 text-ffa14a border border-ffa14a rounded-full hover:text-ffbb7c hover:cursor-pointer">{{ __('Registrati') }}</div>
                @endguest
                <x-dropdown>
                    <x-slot:trigger>
                        <button type="button"
                                class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a uppercase hover:text-00abc0"
                                aria-expanded="false">
                            {{ auth()->user()?->language ?? config('app.locale') }}
                            <svg class="h-4 w-4 flex-none text-0d171a group-hover:text-00abc0" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot:trigger>
                    <x-slot:content>
                        @foreach(config('tripsytour.languages') as $code => $language)
                            @if($code !== auth()->user()?->language)
                                <x-dropdown-link>{{ $language }}</x-dropdown-link>
                            @endif
                        @endforeach
                    </x-slot:content>
                </x-dropdown>
                @auth
                    <a href="{{ route('guest.favorites') }}" class="{{request()->route()->getName() === 'guest.favorites' ? 'text-00abc0' : ''}} hover:text-00abc0">
                        <x-heroicon-o-heart class="w-5 h-5 shrink-0"/>
                    </a>
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
                            @endhasanyrole
                            @hasanyrole('partner|administrator')
                            <x-dropdown-link href="{{ route('partner.profile.show') }}">
                                {{ __('Profilo') }}
                            </x-dropdown-link>
                            @else
                                <x-dropdown-link href="{{ route('guest.profile.show') }}">
                                    {{ __('Profilo') }}
                                </x-dropdown-link>
                                @endhasanyrole

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
                @endauth
                <a href="{{ route('guest.cart') }}" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                    </svg>
                    <div
                        class="absolute -top-3.5 -right-3.5 grid place-items-center bg-00abc0 w-5 h-5 rounded-full text-white font-medium text-xs">
                        <span>{{ $cart_items }}</span>
                    </div>
                </a>
            </div>
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
                                    <span>{{ __('Esperienze') }}</span>
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
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">Arte
                                            e Cultura</a>
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">Enogastronomia</a>
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">Escursioni
                                            a Cavallo</a>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{open: false}" class="relative w-full">
                                <button x-on:click="open = true" type="button"
                                        class="group flex items-center justify-between gap-x-1 w-full font-semibold leading-6 text-0d171a mx-auto hover:text-00abc0"
                                        aria-expanded="false">
                                    <span>{{ __('Destinazioni') }}</span>
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
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">Alghero</a>
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">Asinara</a>
                                        <a href="#"
                                           class="block font-medium text-sm text-0d171a hover:text-00abc0">Bosa</a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('guest.gift-cards') }}"
                               class="font-semibold leading-6 text-0d171a hover:text-00abc0">{{ __('Buoni Regalo') }}</a>
                            <div x-data="{open: false}" class="relative w-full">
                                <button x-on:click="open = true" type="button"
                                        class="group flex items-center justify-between gap-x-1 w-full font-semibold leading-6 text-0d171a mx-auto hover:text-00abc0"
                                        aria-expanded="false">
                                    <span>ITA</span>
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
                                        <a href="#" class="block font-medium text-sm text-0d171a hover:text-00abc0">English</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-4 py-6">
                        @guest
                            <a href="{{ route('login') }}"
                               class="font-semibold leading-6 text-center text-ffa14a hover:text-ffbb7c">{{ __('Accedi') }}</a>
                            <x-tripsy-button color="orange" href="#">{{ __('Registrati') }}</x-tripsy-button>
                        @endguest
                        @auth
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
                                        @endhasanyrole
                                        <a href="{{ route('guest.profile.show') }}"
                                           class="block font-medium text-sm text-0d171a hover:text-00abc0">
                                            {{ __('Profilo') }}
                                        </a>
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
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
