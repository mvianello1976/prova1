<div class="space-y-4">
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="border rounded bg-white p-8">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Crea una nuova disponibilità') }}</h3>
            <div class="space-y-3 mt-8">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <x-select
                            wire:model.live="form.product_id"
                            class="w-full"
                            :disabled="$form->availability->current_step"
                            label="{{ __('Seleziona attività') }}"
                        >
                            <option value="">{{ __('Seleziona') }}</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    @if($form->product_id)
                        @if($form->typology_id !== 6)
                            <div class="col-span-1">
                                <x-select
                                    wire:model.live="form.participants"
                                    class="w-full"
                                    :disabled="$form->availability->current_step"
                                    label="{{ __('N. Persone') }}"
                                >
                                    <option value="">{{ __('Seleziona') }}</option>
                                    @foreach($participants as $participant)
                                        <option value="{{ $participant }}">{{ $participant }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            {{--                        @else--}}
                            {{--                            <div class="col-span-1">--}}
                            {{--                                <x-select--}}
                            {{--                                    wire:model.live="form.vehicles"--}}
                            {{--                                    class="w-full"--}}
                            {{--                                    :disabled="$form->availability->current_step"--}}
                            {{--                                    label="{{ __('N. Mezzi') }}"--}}
                            {{--                                >--}}
                            {{--                                    <option value="">{{ __('Seleziona') }}</option>--}}
                            {{--                                    @foreach($participants as $participant)--}}
                            {{--                                        <option value="{{ $participant }}">{{ $participant }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </x-select>--}}
                            {{--                            </div>--}}
                        @endif
                    @endif
                </div>
            </div>
            @if(!$form->availability->current_step)
                <div class="mt-8 flex items-center justify-end">
                    <div class="flex space-x-2">
                        <x-tripsy-button
                            wire:click="cancel"
                            wire:confirm="{{ __('Se esci, tutti i dati inseriti verranno persi. Continuare?') }}"
                        >{{ __('Cancella') }}</x-tripsy-button>
                        <x-tripsy-button
                            color="orange"
                            wire:click="next"
                            wire:loading.attr="disabled"
                        >
                            {{ __('Avanti') }}
                        </x-tripsy-button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($form->availability->current_step)
        <div class="max-w-5xl mx-auto space-y-8">
            <div class="border rounded bg-white p-8">
                <div class="flex justify-center mb-10">
                    <nav class="relative w-full mx-auto">
                        <ol class="flex items-start">
                            @foreach($steps as $k => $step)
                                <li class="relative flex flex-col items-center justify-center text-center space-y-2 w-14">
                                    <div
                                        class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 ring-2 ring-offset-1 ring-fafcfc {{ $form->availability->current_step >= $k ? 'border-00abc0 bg-00abc0' : 'border-b0b7be bg-fafcfc' }}">
                                    <span
                                        class="text-xs font-semibold {{ $form->availability->current_step >= $k ? 'text-white' : 'text-b0b7be' }}">
                                        @if($form->availability->current_step <= $k)
                                            {{ $k }}
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m4.5 12.75 6 6 9-13.5"/>
                                        </svg>
                                        @endif
                                    </span>
                                    </div>
                                    <span
                                        class="text-xs font-semibold {{ $form->availability->current_step >= $k ? 'text-00abc0' : 'text-b0b7be' }}">
                                        {{ $step }}
                                    </span>
                                </li>
                                @if(!$loop->last)
                                    <div
                                        class="relative flex-1 h-0.5 w-full top-4 {{ $form->availability->current_step > $k ? 'bg-00abc0' : 'bg-b0b7be' }}"></div>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
                @if($form->availability->current_step === 1)
                    <div>
                        <p class="text-sm text-1e2e33">{{ __('Seleziona il periodo in cui è disponibile la tua attività, puoi valutare di inserire più fasce orarie per essere preciso, così i clienti avranno la sicurezza di ciò che acquistano.') }}</p>
                        @error('form.overlap')
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
                        <div class="space-y-8">
                            @foreach($form->availability_dates as $k => $availability_date)
                                <div class="relative mt-5 space-y-4 border p-2 pr-6">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="space-y-1 flex-1">
                                            <x-label>{{ __('Periodo dal - al') }}</x-label>
                                            <x-b2b-datepicker wire:model.live="form.availability_dates.{{ $k }}.dates" range
                                                              autoclose/>
                                            <x-input-error for="form.availability_dates.{{ $k }}.dates"></x-input-error>
                                        </div>
                                        <div class="space-y-1 flex-1">
                                            <x-label>{{ __('Inizio attività') }}</x-label>
                                            <x-timepicker wire:model.live="form.availability_dates.{{ $k }}.time_start"/>
                                            {{--                                            <x-b2b-datepicker wire:model.live="form.availability_dates.{{ $k }}.time_start"--}}
                                            {{--                                                              timepicker autoclose/>--}}
                                            <x-input-error
                                                for="form.availability_dates.{{ $k }}.time_start"></x-input-error>
                                        </div>
                                        <div class="space-y-1 flex-1">
                                            <x-label>{{ __('Ultima partenza') }}</x-label>
                                            <x-timepicker wire:model.live="form.availability_dates.{{ $k }}.time_end"/>
                                            {{--                                            <x-b2b-datepicker wire:model.live="form.availability_dates.{{ $k }}.time_end"--}}
                                            {{--                                                              timepicker--}}
                                            {{--                                                              autoclose/>--}}
                                            <x-input-error for="form.availability_dates.{{ $k }}.time_end"></x-input-error>
                                        </div>
                                        <div class="flex-1">
                                            <x-select wire:model.live="form.availability_dates.{{ $k }}.step"
                                                      label="{{ __('Partenza ogni') }}">
                                                <option value=""></option>
                                                @foreach(config('tripsytour.product.availabilities.steps') as $step)
                                                    <option
                                                        value="{{ $step }}">{{ trans_choice(':count minuti', $step) }}</option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                    </div>
                                    @if($form->typology_id === 6)
                                        <div class="grid grid-cols-4 gap-4">
                                            <div class="flex-1">
                                                <x-input wire:model.live="form.availability_dates.{{ $k }}.vehicles_per_slot" type="number" step="1" min="0" label="{{ __('N. Mezzi/partenza') }}"/>
                                            </div>
                                            <div class="flex-1">
                                                <x-input wire:model.live="form.availability_dates.{{ $k }}.participants_per_vehicle" type="number" step="1" min="0" label="{{ __('N. persone/mezzo') }}"/>
                                            </div>
                                        </div>
                                    @endif
                                    <div wire:click="removeAvailabilityDate({{$k}})"
                                         class="absolute -top-8 -right-3.5 mt-8 px-1.5 py-1.5 bg-red-500 rounded text-white hover:cursor-pointer">
                                        <x-heroicon-o-trash class="w-4 h-4"/>
                                    </div>
                                </div>
                            @endforeach
                            <span wire:click="addAvailabilityDates"
                                  class="!mt-5 inline-flex items-center space-x-1 text-sm text-03b8ce font-semibold hover:cursor-pointer">
                                    <x-heroicon-o-plus class="w-4 h-4"/>
                                    <span>{{ __('Aggiungi disponibilità') }}</span>
                                </span>
                        </div>
                    </div>
                @endif
                @if($form->availability->current_step === 2)
                    <div>
                        <div class="space-y-8">
                            @foreach($form->availability_dates as $k => $availability_date)
                                <div class="relative mt-5 flex items-start gap-x-3">
                                    <div class="space-y-1 flex-1">
                                        <x-label>{{ __('Periodo dal - al') }}</x-label>
                                        <div
                                            class="h-14 flex flex-col justify-center px-2 w-full text-sm text-0d171a border border-e2eaeb rounded opacity-50 cursor-not-allowed">
                                            <div>
                                                @php
                                                    $date_start = gettype($availability_date['dates'][0]) === 'string' ? $availability_date['dates'][0] : $availability_date['dates'][0]->format('d/m/Y');
                                                    $date_end = gettype($availability_date['dates'][1]) === 'string' ? $availability_date['dates'][1] : $availability_date['dates'][1]->format('d/m/Y');
                                                @endphp
                                                <span class="font-semibold">{{ "$date_start - $date_end" }}</span>
                                            </div>
                                            @php
                                                $time_start = gettype($availability_date['time_start']) === 'string' ? $availability_date['time_start'] : $availability_date['time_start']->format('H:i');
                                                $time_end = gettype($availability_date['time_end']) === 'string' ? $availability_date['time_end'] : $availability_date['time_end']->format('H:i')
                                            @endphp
                                            <span>{{ "$time_start - $time_end" }}</span>
                                        </div>
                                    </div>
                                    @if($form->typology_id !== 6)
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.availability_dates.{{$k}}.adults_price"
                                                type="number"
                                                min="0"
                                                label="{{ __('Costo per adulto') }}"
                                                hint="{{ __('Età 17+ anni') }}"
                                            />
                                        </div>
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.availability_dates.{{$k}}.kids_price"
                                                type="number"
                                                min="0"
                                                label="{{ __('Costo per ragazzo') }}"
                                                hint="{{ __('Età 8-16 anni') }}"
                                            />
                                        </div>
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.availability_dates.{{$k}}.children_price"
                                                type="number"
                                                min="0"
                                                label="{{ __('Costo per bambino') }}"
                                                hint="{{ __('Fino a 7 anni') }}"
                                            />
                                        </div>
                                    @else
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.availability_dates.{{ $k }}.rental_total_price"
                                                type="number"
                                                min="0"
                                                label="{{ __('Costo totale noleggio') }}"
                                            />
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            {{--                            <span wire:click="addAvailabilityDates"--}}
                            {{--                                  class="!mt-5 inline-flex items-center space-x-1 text-sm text-03b8ce font-semibold hover:cursor-pointer">--}}
                            {{--                                    <x-heroicon-o-plus class="w-4 h-4"/>--}}
                            {{--                                    <span>{{ __('Aggiungi disponibilità') }}</span>--}}
                            {{--                                </span>--}}
                        </div>
                    </div>
                @endif
                @if($form->availability->current_step === 3)
                    <div>
                        <div class="space-y-8 text-center">
                            <x-heroicon-o-check-circle class="mx-auto w-12 h-12 text-67b26a"/>
                            <h3 class="text-1e2e33 text-xl font-medium">{{ __('Disponibilità inserita correttamente') }}</h3>
                            <x-tripsy-button
                                color="orange"
                                href="{{ route('availabilities.index') }}"
                            >
                                {{ __('Chiudi') }}
                            </x-tripsy-button>
                        </div>
                    </div>
                @endif

                @if($form->availability->current_step !== 3)
                    <div class="mt-8 flex items-center justify-end">
                        <div class="flex space-x-2">
                            <x-tripsy-button
                                wire:click="cancel"
                                wire:confirm="{{ __('Se esci, tutti i dati inseriti verranno persi. Continuare?') }}"
                            >{{ __('Cancella') }}</x-tripsy-button>
                            <x-tripsy-button
                                color="orange"
                                wire:click="next"
                                wire:loading.attr="disabled"
                            >
                                {{ __('Avanti') }}
                            </x-tripsy-button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        function askConfirmation(event) {
            let confirmation = confirm("{{__('Se esci, tutti i dati inseriti verranno persi. Continuare?')}}");
            if (!confirmation) {
                event.preventDefault();
                event.returnValue = '';
            } else {
                exitConfirmation = true;
                Livewire.dispatch('delete-availability');
            }
        }

        document.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function (event) {
                askConfirmation(event);
            });
        });

        // Gestire il ricaricamento della pagina
        window.addEventListener('beforeunload', function (event) {
            if (!exitConfirmation) {
                askConfirmation(event);
            }
        });

        // Prevenire combinazioni da tastiera per il ricaricamento della pagina
        window.addEventListener('keydown', function (event) {
            if ((event.ctrlKey || event.metaKey) && (event.key === 'r' || event.key === 'R')) {
                askConfirmation(event);
            } else if (event.key === 'F5') {
                askConfirmation(event);
            }
        });
    </script>
@endpush
