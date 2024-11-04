<header x-cloak x-data="{open: false}" class="relative z-20 bg-white shadow-sm">
    <nav
        class="{{ request()->route()->getName() === 'guest.index' ? 'fixed w-full' : '' }} container flex items-center justify-between py-3 lg:static">
        <a href="{{ route('guest.index') }}">
            <x-application-logo class="h-14 w-auto" colored></x-application-logo>
        </a>
        <div class="flex flex-1 justify-end">
            <a href="#" class="group flex items-center gap-x-1 text-sm font-semibold leading-6 text-0d171a hover:text-00abc0">
                {{ __('Aiuto') }}
            </a>
        </div>
    </nav>
</header>
