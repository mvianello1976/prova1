<div class="p-4 space-y-8">
    <div class="text-center">
        <h3 class="text-xl text-006cbc font-semibold">{{ __('Benvenuto') }}</h3>
    </div>
    <div>
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                @foreach($tabs as $k => $tab)
                    <span wire:click="$set('currentTab', '{{$k}}')"
                          class="flex-1 {{ $k === $currentTab ? 'border-03b8ce text-03b8ce' : 'border-transparent text-b0b7be hover:text-627277' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm text-center font-medium hover:cursor-pointer"
                          tabindex="-1">{{ __($tab) }}</span>
                @endforeach
            </nav>
        </div>
    </div>

    <form wire:submit.prevent="submit" class="space-y-6">
        <x-input type="email" wire:model="form.email" label="{{ __('Email') }}" required/>
        <x-input type="password" wire:model="form.password" label="{{ __('Password') }}" required>
            @if (Route::has('password.request'))
                <x-slot:hint>
                    <a href="{{ route('password.request') }}"
                       class="text-006cbc underline font-semibold">{{ __('Password dimenticata') }}</a>
                </x-slot:hint>
            @endif
        </x-input>
        @error('invalid_credentials')
        <p class="text-xs text-red-500">{{$message}}</p>
        @enderror
        <div class="text-center">
            <x-tripsy-button
                wire:click="submit"
                color="orange"
            >
                {{ __('Accedi') }}
            </x-tripsy-button>
        </div>
    </form>
    @env('local')
        <x-login-link
            label="Admin Login"
            email="admin@example.test"
        />
        <x-login-link
            label="Partner Login"
            email="partner@example.test"
        />
        <x-login-link
            label="Client Login"
            email="client@example.test"
        />
    @endenv
    @if($currentTab === 'client')
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-2 text-sm text-gray-500">{{ __('oppure') }}</span>
            </div>
        </div>
        <div>
            social links
        </div>
    @elseif($currentTab === 'partner')
        <p class="text-sm text-1e2e33 text-center">
            {{ __('Non hai un\'account?') }}
            <a href="{{ route('register') }}" class="text-ffa14a underline font-semibold">{{ __('Registrati adesso') }}</a>
        </p>
    @endif
</div>
