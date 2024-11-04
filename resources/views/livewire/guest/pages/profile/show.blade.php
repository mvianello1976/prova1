<div class="bg-fafcfc">
    <div class="container py-10">
        <div class="grid grid-cols-3 items-start gap-10">
            <div class="col-span-3 shadow-lg rounded-md overflow-hidden lg:col-span-1">
                <div class="bg-fff2e6 px-6 py-5 lg:py-12">
                    <h3 class="text-ffa14a font-semibold text-xl">{{ auth()->user()->full_name }}</h3>
                </div>
                <div x-data="{ currentTab: @entangle('currentTab')}" class="bg-white px-4 divide-y divide-e2eaeb">
                    <div x-data="{ open: false }" x-init="$watch('currentTab', () => open = false)">
                        <div x-on:click="currentTab = 'profile'; open = true" wire:click="$set('currentTab', 'profile')" class="flex items-center justify-between rounded text-center text-sm py-4 hover:cursor-pointer {{ $currentTab === 'profile' ? 'lg:bg-white lg:text-0d171a lg:font-semibold' : 'lg:bg-transparent lg:text-0d171a lg:hover:text-00abc0' }}"
                             :class="open ? 'bg-white text-0d171a font-semibold' : 'bg-transparent text-0d171a'"
                        >
                            <div class="flex items-center space-x-2">
                                <x-heroicon-o-user
                                    class="w-5 h-5 {{ $currentTab === 'profile' ? 'lg:stroke-1.5' : 'lg:stroke-1' }}"
                                    x-bind:class="open ? 'stroke-1.5' : 'stroke-1'"
                                />
                                <span>
                                {{ __('Profilo') }}
                            </span>
                            </div>
                            <x-heroicon-o-chevron-down
                                class="w-4 h-4 lg:hidden"
                                x-bind:class="open ? 'rotate-180' : ''"
                            />
                        </div>
                        <div x-cloak x-show="currentTab === 'profile' && open" class="pb-4 lg:hidden">
                            <livewire:guest.pages.profile.tabs.profile wire:key="profile-mobile"/>
                        </div>
                    </div>
                    <div x-data="{ open: false }" x-init="$watch('currentTab', () => open = false)">
                        <div x-on:click="currentTab = 'security'; open = true" wire:click="$set('currentTab', 'security')" class="flex items-center justify-between rounded text-center text-sm py-4 hover:cursor-pointer {{ $currentTab === 'security' ? 'lg:bg-white lg:text-0d171a lg:font-semibold' : 'lg:bg-transparent lg:text-0d171a lg:hover:text-00abc0' }}"
                             :class="open ? 'bg-white text-0d171a font-semibold' : 'bg-transparent text-0d171a'"
                        >
                            <div class="flex items-center space-x-2">
                                <x-heroicon-o-lock-closed
                                    class="w-5 h-5 {{ $currentTab === 'security' ? 'lg:stroke-1.5' : 'lg:stroke-1' }}"
                                    x-bind:class="open ? 'stroke-1.5' : 'stroke-1'"
                                />
                                <span>
                                {{ __('Sicurezza') }}
                            </span>
                            </div>
                            <x-heroicon-o-chevron-down
                                class="w-4 h-4 lg:hidden"
                                x-bind:class="open ? 'rotate-180' : ''"
                            />
                        </div>
                        <div x-cloak x-show="currentTab === 'security' && open" class="pb-4 lg:hidden">
                            <livewire:guest.pages.profile.tabs.security wire:key="security-mobile"/>
                        </div>
                    </div>
                    <div x-data="{ open: false }" x-init="$watch('currentTab', () => open = false)">
                        <div x-on:click="currentTab = 'bookings'; open = true" wire:click="$set('currentTab', 'bookings')" class="flex items-center justify-between rounded text-center text-sm py-4 hover:cursor-pointer {{ $currentTab === 'bookings' ? 'lg:bg-white lg:text-0d171a lg:font-semibold' : 'lg:bg-transparent lg:text-0d171a lg:hover:text-00abc0' }}"
                             :class="open ? 'bg-white text-0d171a font-semibold' : 'bg-transparent text-0d171a'"
                        >
                            <div class="flex items-center space-x-2">
                                <x-heroicon-o-calendar-days
                                    class="w-5 h-5 {{ $currentTab === 'bookings' ? 'lg:stroke-1.5' : 'lg:stroke-1' }}"
                                    x-bind:class="open ? 'stroke-1.5' : 'stroke-1'"
                                />
                                <span>
                                {{ __('Prenotazioni') }}
                            </span>
                            </div>
                            <x-heroicon-o-chevron-down
                                class="w-4 h-4 lg:hidden"
                                x-bind:class="open ? 'rotate-180' : ''"
                            />
                        </div>
                        <div x-cloak x-show="currentTab === 'bookings' && open" class="pb-4 lg:hidden">
                            <livewire:guest.pages.profile.tabs.bookings wire:key="bookings-mobile"/>
                        </div>
                    </div>
                    <div x-data="{ open: false }" x-init="$watch('currentTab', () => open = false)">
                        <div x-on:click="currentTab = 'gift-cards'; open = true" wire:click="$set('currentTab', 'gift-cards')" class="flex items-center justify-between rounded text-center text-sm py-4 hover:cursor-pointer {{ $currentTab === 'gift-cards' ? 'lg:bg-white lg:text-0d171a lg:font-semibold' : 'lg:bg-transparent lg:text-0d171a lg:hover:text-00abc0' }}"
                             :class="open ? 'bg-white text-0d171a font-semibold' : 'bg-transparent text-0d171a'"
                        >
                            <div class="flex items-center space-x-2">
                                <x-heroicon-o-gift
                                    class="w-5 h-5 {{ $currentTab === 'gift-cards' ? 'lg:stroke-1.5' : 'lg:stroke-1' }}"
                                    x-bind:class="open ? 'stroke-1.5' : 'stroke-1'"
                                />
                                <span>
                                {{ __('Gift Card') }}
                            </span>
                            </div>
                            <x-heroicon-o-chevron-down
                                class="w-4 h-4 lg:hidden"
                                x-bind:class="open ? 'rotate-180' : ''"
                            />
                        </div>
                        <div x-cloak x-show="currentTab === 'gift-cards' && open" class="pb-4 lg:hidden">
                            <livewire:guest.pages.profile.tabs.gift-cards wire:key="gift-cards-mobile"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block lg:col-span-2">
                @switch($currentTab)
                    @case('profile')
                        <livewire:guest.pages.profile.tabs.profile wire:key="profile-desktop"/>
                        @break
                    @case('security')
                        <livewire:guest.pages.profile.tabs.security wire:key="security-desktop"/>
                        @break
                    @case('bookings')
                        <livewire:guest.pages.profile.tabs.bookings wire:key="bookings-desktop"/>
                        @break
                    @case('gift-cards')
                        <livewire:guest.pages.profile.tabs.gift-cards wire:key="gift-cards-desktop"/>
                        @break
                @endswitch
            </div>
        </div>
    </div>
</div>
