<div class="space-y-4">
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="border rounded bg-white p-8">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Crea una nuova offerta speciale') }}</h3>
            <div class="space-y-6 mt-8">
                <x-input
                    wire:model.live="form.name"
                    type="text"
                    label="{{ __('Titolo offerta') }}"
                    hint="{{ __('I clienti non vedranno questo titolo') }}"
                />
                <x-select
                    wire:model.live="form.product_id"
                    class="w-full"
                    label="{{ __('Seleziona attività') }}"
                >
                    <option value="">{{ __('Seleziona') }}</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </x-select>
                @if($form->product_id)
                    <div>
                        <x-label>{{ __('Validità offerta') }}</x-label>
                        <x-b2b-datepicker
                            wire:model.live="form.dates"
                            range
                            autoclose
                            class="mt-1"
                        />
                        <x-input-error for="form.dates"></x-input-error>
                        @error('form.overlap')
                        <x-input-error for="form.overlap"></x-input-error>
                        @enderror
                    </div>
                    <div>
                        <x-label>{{ __('Tipologia offerta') }}</x-label>
                        <div class="flex items-center space-x-4 mt-1">
                            @foreach($form->types as $k => $label)
                                <x-radio-small-card
                                    wire:model.live="form.type"
                                    :class="$form->type === $k ? 'border-03b8ce bg-03b8ce/5 text-03b8ce' : 'border-e2eaeb text-1e2e33'"
                                    :value="$k"
                                >
                                    {{ __($label) }}
                                </x-radio-small-card>
                            @endforeach
                        </div>
                    </div>
                    @if($form->type)
                        @switch($form->type)
                            @case('percentage')
                                <div class="flex-1">
                                    <x-input
                                        wire:model.live="form.percentage"
                                        type="number"
                                        min="0"
                                        label="{{ __('Sconto in %') }}"
                                    />
                                </div>
                                @break
                            @case('cash')
                                @if($form->typology_id === 6)
                                    <x-input
                                        wire:model.live="form.rental_total_price"
                                        type="number"
                                        min="0"
                                        hint="{{ __('Attualmente: ') }}{{ $form->current_prices ? money($form->current_prices->rental_total_price, forceDecimals: true) : '-' }}"
                                        label="{{ __('Costo totale noleggio') }}"
                                    />
                                @else
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.adults_price"
                                                type="number"
                                                min="0"
                                                hint="{{ __('Attualmente: ') }}{{ $form->current_prices ? money($form->current_prices->adults_price, forceDecimals: true) : '-' }}"
                                                label="{{ __('Costo per adulto') }}"
                                            />
                                        </div>
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.kids_price"
                                                type="number"
                                                min="0"
                                                hint="{{ __('Attualmente: ') }}{{ $form->current_prices ? money($form->current_prices->kids_price, forceDecimals: true) : '-' }}"
                                                label="{{ __('Costo per ragazzo') }}"
                                            />
                                        </div>
                                        <div class="flex-1">
                                            <x-input
                                                wire:model.live="form.children_price"
                                                type="number"
                                                min="0"
                                                hint="{{ __('Attualmente: ') }}{{ money($form->current_prices?->children_price, forceDecimals: true) }}"
                                                label="{{ __('Costo per bambino') }}"
                                            />
                                        </div>
                                    </div>
                                @endif
                                @break
                        @endswitch
                    @endif
                @endif
            </div>
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
                        :disabled="$errors->has('form.overlap')"
                    >
                        {{ __('Salva') }}
                    </x-tripsy-button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function (event) {
                var conferma = confirm("{{__('Se esci, tutti i dati inseriti verranno persi. Continuare?')}}");
                if (conferma) {
                    Livewire.dispatch('delete-special');
                } else {
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
