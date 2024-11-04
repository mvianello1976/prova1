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
        <x-input type="text" wire:model="form.first_name" label="{{ __('Nome') }}" required/>
        <x-input type="text" wire:model="form.last_name" label="{{ __('Cognome') }}" required/>
        <x-input type="email" wire:model="form.email" label="{{ __('Email') }}" required/>
        <div class="grid grid-cols-2 gap-4">
            <x-input type="password" wire:model="form.password" label="{{ __('Password') }}" required/>
            <x-input type="password" wire:model="form.password_confirmation" label="{{ __('Conferma Password') }}" required/>
        </div>

        @if($currentTab === 'client')
            <div class="space-y-4">
                <div class="flex items-center">
                    <input wire:model="form.newsletter" type="checkbox"
                           class="h-5 w-5 rounded-full border-gray-300 text-ffbb7c focus:ring-ffbb7c">
                    <label for="email"
                           class="ml-3 block text-xs text-627277">{{ __('Iscriviti alla newsletter') }}</label>
                </div>
                <div class="flex items-center">
                    <input wire:model="form.marketing" type="checkbox"
                           class="h-5 w-5 rounded-full border-gray-300 text-ffbb7c focus:ring-ffbb7c">
                    <label for="sms"
                           class="ml-3 block text-xs text-627277">{{ __('Acconsento all\'uso dei miei dati personali per ricevere promozioni esclusive') }}</label>
                </div>
            </div>
        @endif

        <div class="text-center">
            <x-tripsy-button
                wire:click="submit"
                color="orange"
            >
                {{ __('Registrati') }}
            </x-tripsy-button>
        </div>
    </form>
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
    @endif
</div>
