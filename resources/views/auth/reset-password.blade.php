<x-blank-layout>
    <div class="max-w-2xl mx-auto border rounded bg-white p-8">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Reimposta password') }}</h3>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-input type="email" name="email" id="email" label="{{ __('Email') }}" :value="old('email')" required autofocus autocomplete="username"/>
            <x-input type="password" name="password" id="password" label="{{ __('Password') }}" required autofocus autocomplete="new-password"/>
            <x-input type="password" name="password_confirmation" id="password_confirmation" label="{{ __('Conferma password') }}" required autofocus autocomplete="new-password"/>

            <div class="flex justify-end">
                <x-tripsy-button color="orange">
                    {{ __('Reset password') }}
                </x-tripsy-button>
            </div>
        </form>
    </div>
</x-blank-layout>
