<x-blank-layout>
    <div class="max-w-2xl mx-auto border rounded bg-white p-8">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Recupera password') }}</h3>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
            @csrf
            <x-input type="email" name="email" id="email" label="{{ __('Email') }}" :value="old('email')" required autofocus autocomplete="username"/>

            <div class="flex justify-end">
                <x-tripsy-button color="orange">
                    {{ __('Invia link di reset') }}
                </x-tripsy-button>
            </div>
        </form>
    </div>
</x-blank-layout>
