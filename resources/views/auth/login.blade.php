<x-blank-layout>
    <div class="max-w-2xl mx-auto border rounded bg-white p-8">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Effettua il login') }}</h3>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <x-input type="email" name="email" id="email" label="{{ __('Email') }}" :value="old('email')" required autofocus autocomplete="username"/>
            <x-input type="password" name="password" id="password" label="{{ __('Password') }}" required autocomplete="current-password">
                @if (Route::has('password.request'))
                    <x-slot:hint>
                        <a href="{{ route('password.request') }}"
                           class="text-006cbc underline font-semibold">{{ __('Password dimenticata') }}</a>
                    </x-slot:hint>
                @endif
            </x-input>

            <div class="flex justify-end">
                <x-tripsy-button color="orange">
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
    </div>
</x-blank-layout>
