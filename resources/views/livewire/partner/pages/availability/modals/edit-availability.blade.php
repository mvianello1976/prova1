<div class="p-4">
    <h3 class="text-xl text-0d171a font-semibold">{{ __('Modifica disponibilità') }}</h3>
    @error('overlap')
    <div class="rounded-md bg-red-50 p-4 mt-3">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    <span>{{ __('Attenzione: ') }}</span>
                    <span class="font-normal text-sm text-red-700">{{ $message }}</span>
                </h3>
            </div>
        </div>
    </div>
    @enderror
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
                    @foreach($form->availability_date->times()->where('sold', '>', 0)->get()->pluck('id') as $time_id)
                        <li>ID Orario: {{ $time_id }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @enderror
    <div class="mt-8 space-y-6">
        <div class="relative mt-5 space-y-4">
            <div class="grid grid-cols-3 gap-4">
                <div class="space-y-1 flex-1 col-span-full">
                    <x-label>{{ __('Periodo dal - al') }}</x-label>
                    <x-b2b-datepicker
                        wire:model.live="form.dates"
                        range
                        autoclose
                        {{--                        :disabledDates="$disabledDates"--}}
                    />
                    <x-input-error for="dates"></x-input-error>
                </div>
                <div class="space-y-1 flex-1">
                    <x-label>{{ __('Inizio attività') }}</x-label>
                    <x-timepicker wire:model.live="form.time_start" />
{{--                    <x-b2b-datepicker wire:model.live="form.time_start"--}}
{{--                                      timepicker autoclose/>--}}
                    <x-input-error
                        for="time_start"></x-input-error>
                </div>
                <div class="space-y-1 flex-1">
                    <x-label>{{ __('Ultima partenza') }}</x-label>
                    <x-timepicker wire:model.live="form.time_end" />
{{--                    <x-b2b-datepicker wire:model.live="form.time_end"--}}
{{--                                      timepicker--}}
{{--                                      autoclose/>--}}
                    <x-input-error for="time_end"></x-input-error>
                </div>
                <div class="flex-1">
                    <x-select wire:model.live="form.step"
                              label="{{ __('Partenza ogni') }}">
                        <option value=""></option>
                        @foreach(config('tripsytour.product.availabilities.steps') as $step)
                            <option
                                value="{{ $step }}">{{ trans_choice(':count minuti', $step) }}</option>
                        @endforeach
                    </x-select>
                </div>
                @if(!$form->availability_date->availability->product->isRental())
                    <div class="flex-1">
                        <x-input
                            wire:model.live="form.adults_price"
                            label="{{ __('Costo per adulto') }}"
                        />
                    </div>
                    <div class="flex-1">
                        <x-input
                            wire:model.live="form.kids_price"
                            label="{{ __('Costo per ragazzo') }}"
                        />
                    </div>
                    <div class="flex-1">
                        <x-input
                            wire:model.live="form.children_price"
                            label="{{ __('Costo per bambino') }}"
                        />
                    </div>
                @endif
            </div>
            @if($form->availability_date->availability->product->isRental())
                <div class="grid grid-cols-4 gap-4">
                    <div class="flex-1">
                        <x-input wire:model.live="form.vehicles_per_slot" type="number" step="1" min="0" label="{{ __('N. Mezzi/partenza') }}"/>
                    </div>
                    <div class="flex-1">
                        <x-input wire:model.live="form.participants_per_vehicle" type="number" step="1" min="0" label="{{ __('N. persone') }}"/>
                    </div>
                </div>
                <div class="flex-1">
                    <x-input wire:model.live="form.rental_total_price" type="number" min="0" label="{{ __('Costo totale noleggio') }}"/>
                </div>
            @endif
        </div>
        <div class="flex items-center justify-end mt-8">
            <div class="space-x-3">
                <x-tripsy-button wire:click="$dispatch('closeModal')" color="gray">
                    {{ __('Annulla') }}
                </x-tripsy-button>
                @error('sold')
                <x-tripsy-button wire:click="submit(true)" color="orange">
                    {{ __('Aggiorna ugualmente') }}
                </x-tripsy-button>
                @else
                    <x-tripsy-button wire:click="submit" color="orange">
                        {{ __('Aggiorna') }}
                    </x-tripsy-button>
                    @enderror
            </div>
        </div>
    </div>
</div>
