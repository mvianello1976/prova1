<div class="p-4">
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Cancella disponibilità') }}</h3>
    @error('sold')
    <div class="rounded-md bg-red-50 p-4 mt-3">
        <div class="flex w-full">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3 w-full">
                <h3 class="text-sm font-medium text-red-800">
                    <span>{{ __('Attenzione: ') }}</span>
                    <span class="font-normal text-sm text-red-700">{{ $message }}</span>
                </h3>
                <ul class="mt-2 text-xs">
                    @foreach($availability_date->times()->where('sold', '>', 0)->get()->pluck('id') as $time_id)
                        <li>ID Orario: {{ $time_id }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @enderror
    <div class="mt-8 space-y-6">
        <p class="text-0d171a text-sm">
            {{ __('Sei sicuro di voler eliminare questa disponibilità?') }}<br>
            {{ __('L\'operazione non potrà essere annullata!') }}
        </p>

        <div class="flex items-center justify-end mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="$dispatch('closeModal')" color="gray">
                    {{ __('Annulla') }}
                </x-tripsy-button>
                <x-tripsy-button wire:click="submit" color="red">
                    {{ __('Elimina') }}
                </x-tripsy-button>
            </div>
        </div>
    </div>
</div>
