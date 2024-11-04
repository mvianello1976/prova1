<div class="max-w-2xl mx-auto border rounded bg-white p-8">
    <div class="flex items-center justify-between">
        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Unisciti a noi come partner') }}</h3>
        <span class="text-sm text-b0b7be font-semibold">{{ __('Step 1 di 3') }}</span>
    </div>
    <div class="mt-8 space-y-6">
        <div wire:key="partner_type">
            <div class="space-y-3">
                <h5 class="text-sm text-0d171a font-semibold">{{ __('Come gestisci la tua attività?') }}</h5>
                <div class="flex space-x-4">
                    <div class="flex-1 space-y-4">
                        <x-radio-small-card
                            wire:model.live="form.partner_type"
                            :class="$form->partner_type === 'company' ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                            value="company"
                        >
                            <div class="flex items-center space-x-3 text-sm">
                                <x-heroicon-o-building-office class="w-5 h-5"/>
                                <span class="font-medium">{{ __('Come azienda') }}</span>
                            </div>
                        </x-radio-small-card>
                    </div>
                    <div class="flex-1 space-y-4">
                        <x-radio-small-card
                            wire:model.live="form.partner_type"
                            :class="$form->partner_type === 'individual' ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                            value="individual"
                        >
                            <div class="flex items-center space-x-3 text-sm">
                                <x-heroicon-o-user class="w-5 h-5"/>
                                <span class="font-medium">{{ __('Come individuo') }}</span>
                            </div>
                        </x-radio-small-card>
                    </div>
                </div>
            </div>
            @error('form.partner_type')
            <x-input-error :for="$form->partner_type">{{ $message }}</x-input-error>
            @enderror
        </div>
        @if($form->partner_type)
            @if($form->partner_type === 'company')
                <div wire:key="company_employees">
                    <div class="space-y-3">
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Quanti dipendenti ha la tua azienda?') }}</h5>
                        <div class="grid grid-cols-3 gap-3 sm:grid-cols-5">
                            @foreach($company_employees_list as $k => $item)
                                <x-radio-small-card
                                    wire:key="{{$k}}"
                                    wire:model.live="form.company_employees"
                                    :class="$form->company_employees == $k ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                                    value="{{ $k }}"
                                >
                                    {{ __($item) }}
                                </x-radio-small-card>
                            @endforeach
                        </div>
                    </div>
                    @error('form.company_employees')
                    <x-input-error :for="$form->company_employees">{{ $message }}</x-input-error>
                    @enderror
                </div>
            @endif
            <div wire:key="activities_provided">
                <div class="space-y-3">
                    <h5 class="text-sm text-0d171a font-semibold">{{ __('Quante attività offrite?') }}</h5>
                    <div class="grid grid-cols-3 gap-3 sm:grid-cols-5">
                        @foreach($activities_provided_list as $k => $item)
                            <x-radio-small-card
                                wire:key="{{$k}}"
                                wire:model.live="form.activities_provided"
                                :class="$form->activities_provided == $k ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                                value="{{ $k }}"
                            >
                                {{ __($item) }}
                            </x-radio-small-card>
                        @endforeach
                    </div>
                </div>
                @error('form.activities_provided')
                <x-input-error :for="$form->activities_provided">{{ $message }}</x-input-error>
                @enderror
            </div>
            <div wire:key="activities_locations">
                <div class="space-y-3">
                    <h5 class="text-sm text-0d171a font-semibold">{{ __('In quali località svolgi le tue attività?') }}</h5>
                    <x-tags wire:model.live="form.activities_locations"/>
                </div>
            </div>
            <div wire:key="activities_use_external_cms">
                <div class="space-y-3">
                    <h5 class="text-sm text-0d171a font-semibold">{{ __('Utilizzi un sistema di prenotazione per gestire le tue attività?') }}</h5>
                    <div class="flex space-x-4">
                        <div class="flex-1 space-y-4">
                            <label
                                class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 focus:outline-none sm:flex sm:justify-between {{ $form->activities_use_external_cms ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33' }}">
                                <input wire:model.live="form.activities_use_external_cms" type="radio"
                                       name="activities_use_external_cms" value="1"
                                       class="sr-only">
                                <div class="flex items-center">
                                    <span class="flex items-center space-x-3 text-sm">
                                        <span class="font-medium">{{ __('Si') }}</span>
                                    </span>
                                </div>
                            </label>
                        </div>
                        <div class="flex-1 space-y-4">
                            <label
                                class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 focus:outline-none sm:flex sm:justify-between {{ !$form->activities_use_external_cms ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33' }}">
                                <input wire:model.live="form.activities_use_external_cms" type="radio"
                                       name="activities_use_external_cms" value="0"
                                       class="sr-only">
                                <div class="flex items-center">
                                    <span class="flex items-center space-x-3 text-sm">
                                        <span class="font-medium">{{ __('No') }}</span>
                                    </span>
                                </div>
                            </label>
                        </div>
                    </div>
                    @error('form.activities_use_external_cms')
                    <x-input-error :for="$form->activities_use_external_cms">{{ $message }}</x-input-error>
                    @enderror
                </div>
            </div>
            @if($form->activities_use_external_cms)
                <div wire:key="activities_external_cms">
                    <div class="space-y-3">
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Seleziona il sistema che utilizzi:') }}</h5>
                        <x-select wire:model.live="form.activities_external_cms">
                            <option value="">{{ __('Seleziona') }}</option>
                            @foreach($activities_external_cms_list as $k => $item)
                                <option value="{{ $k }}">
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
            @endif
        @endif
        <div class="flex justify-end">
            <x-tripsy-button
                color="orange"
                wire:click="next"
                wire:loading.attr="disabled"
            >
                {{ __('Avanti') }}
            </x-tripsy-button>
        </div>
    </div>
</div>
