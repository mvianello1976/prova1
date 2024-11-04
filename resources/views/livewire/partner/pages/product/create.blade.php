<div>
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="border rounded bg-white p-8">
            @if($form->product->current_step === 1 || $form->product->temporary_step === 1)
                <x-product-create-card :item="$form->product">
                    <x-input-error for="form.category_id"></x-input-error>
                    <x-slot:title>{{ __('Crea un nuovo prodotto') }}</x-slot:title>
                    <x-slot:content_title>{{ __('Qual è l\'ambito in cui rientra la tua attività?') }}</x-slot:content_title>
                    <x-slot:content_subtitle>{{ __('Questo ci aiuta a classificare il tuo prodotto in modo che i clienti possano trovarlo.') }}</x-slot:content_subtitle>
                    @foreach($categories as $category)
                        <x-radio
                            wire:key="{{ $category->id }}"
                            wire:model.live="form.category_id"
                            value="{{ $category->id }}"
                        >
                            {{ $category->name }}
                        </x-radio>
                    @endforeach
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 2 || $form->product->temporary_step === 2)
                <x-product-create-card :item="$form->product">
                    <x-input-error for="form.typology_id"></x-input-error>
                    <x-slot:title>{{ __('Crea un nuovo prodotto') }}</x-slot:title>
                    <x-slot:content_title>{{ __('Seleziona la tipologia di servizio') }}</x-slot:content_title>
                    <x-slot:content_subtitle>{{ __('Questo ci aiuta a classificare il tuo prodotto in modo che i clienti possano trovarlo.') }}</x-slot:content_subtitle>
                    @foreach($typologies as $typology)
                        <x-radio
                            wire:key="{{ $typology->id }}"
                            wire:model.live="form.typology_id"
                            value="{{ $typology->id }}"
                        >
                            {{ $typology->name }}
                            <x-slot:description>
                                {{ $typology->description }}
                            </x-slot:description>
                        </x-radio>
                    @endforeach
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 3 || $form->product->temporary_step === 3)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Titolo') }}</x-slot:title>
                    <x-slot:content_title>{{ __('Qual è il titolo del tuo prodotto?') }}</x-slot:content_title>
                    <x-slot:content_subtitle>{{ __('Scrivi un breve titolo descrittivo per aiutare i clienti a comprendere il tuo prodotto.') }}</x-slot:content_subtitle>
                    <div class="text-xs text-627277">
                        <h5 class="font-semibold">{{ __('Dovrebbe includere') }}</h5>
                        <ul class="list-disc list-inside space-y-0.5 mt-1">
                            <li>{{ __('Il luogo principale dell\'attività (dove inizia o si svolge l\'attività)') }}</li>
                            <li>{{ __('Il tipo di attività (ad esempio un biglietto d\'ingresso, un tour a piedi, una gita di un giorno intero, ecc..)') }}</li>
                            <li>{{ __('Eventuali inclusioni importanti (ad esempio trasporto, pasti ecc..)') }}</li>
                        </ul>
                    </div>
                    <div class="text-xs text-0d171a bg-eff4f5 p-2">
                        <h5 class="font-semibold">{{ __('Esempi') }}:</h5>
                        <ul class="space-y-0.5 mt-1">
                            <li class="flex items-center space-x-2">
                                <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                <span>{{ __('Santorini: tour delle principali attrazioni con degustazione e tramonto a Oia') }}</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                <span>{{ __('Roma: Vaticano, Cappella Sistina e tour a San Pietro') }}</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                <span>{{ __('Da Dublino: gita di un giorno al Selciato del Gigante e alla città di Belfast') }}</span>
                            </li>
                        </ul>
                    </div>
                    <x-input wire:model="form.name" type="text" label="{{ __('Titolo') }}"></x-input>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 4 || $form->product->temporary_step === 4)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Descrizione') }}</x-slot:title>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Presenta il tuo prodotto') }}</h5>
                            <p class="text-xs text-627277">{{ __('Dai al cliente un assaggio di ciò che farà in 2 o 3 frasi. Questa sarà la prima cosa che i clienti leggeranno dopo il titolo e li ispirerà a continuare') }}</p>
                        </div>
                        <x-textarea
                            wire:model="form.description"
                            class="resize-none"
                            maxlength="200"
                            hint="counter"
                        />
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Punti salienti del prodotto') }}</h5>
                            <p class="text-xs text-627277">{{ __('Approfondisci l\'esperienza') }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">

                            <x-select wire:model="form.cancellation" label="{{ __('Cancellazione') }}">
                                <option value="">{{ __('Seleziona') }}</option>
                                @foreach(config('tripsytour.cancellations') as $k => $item)
                                    <option value="{{ $k }}">{{ __($item['label']) }}</option>
                                @endforeach
                            </x-select>
                            <x-select wire:model="form.duration" label="{{ __('Durata') }}">
                                <option value="">{{ __('Seleziona') }}</option>
                                @for($n = 1; $n <= 10; $n++)
                                    <option
                                        value="{{$n}}">{{ trans_choice('{1} :count ora|[2,*] :count ore', $n) }}</option>
                                @endfor
                            </x-select>
                            <x-select wire:model="form.difficulty" label="{{ __('Difficoltà') }}">
                                <option value="">{{ __('Seleziona') }}</option>
                                @foreach(config('tripsytour.difficulties') as $k => $label)
                                    <option value="{{ $k }}">{{ __($label) }}</option>
                                @endforeach
                            </x-select>
                            <x-select wire:model="form.pets_allowed" label="{{ __('Animali') }}">
                                <option value="">{{ __('Seleziona') }}</option>
                                <option value="1">{{ __('Animali ammessi') }}</option>
                                <option value="0">{{ __('Animali non ammessi') }}</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Accessibilità') }}</h5>
                            <p class="text-xs text-627277">{{ __('Seleziona un\'opzione') }}</p>
                        </div>
                        <x-radio
                            wire:model.live="form.accessibility"
                            value="0"
                        >
                            {{ __('Non accessibile a persone con disabilità') }}
                        </x-radio>
                        <x-radio
                            wire:model.live="form.accessibility"
                            value="1"
                        >
                            {{ __('Accessibile ai disabili') }}
                            <x-slot:description>
                                {{ __('Non sono presenti barriere architettoniche che impediscono o rendono complicati i passaggi') }}
                            </x-slot:description>
                        </x-radio>
                        <x-input-error for="form.accessibility"></x-input-error>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Personale d\'accoglienza') }}</h5>
                            <p class="text-xs text-627277">{{ __('È possibile selezionare più di un\'opzione') }}</p>
                        </div>
                        @foreach(config('tripsytour.reception_staff') as $k => $label)
                            <x-checkbox
                                wire:key="{{ $k }}"
                                wire:model.live="form.reception_staff"
                                value="{{ $k }}"
                            >
                                {{ __($label) }}
                            </x-checkbox>
                        @endforeach
                        <x-input-error for="form.reception_staff"></x-input-error>
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 5 || $form->product->temporary_step === 5)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Località') }}</x-slot:title>
                    <x-gmaps label="{{ __('Dove si trova la tua attività?') }}" name="gmaps" :types="['locality']">
                        <x-slot:prepend>
                            <x-heroicon-o-magnifying-glass
                                class="w-5 h-5 text-627277"></x-heroicon-o-magnifying-glass>
                        </x-slot:prepend>
                        @if($product->destination)
                            <x-slot:hint>
                                {{ __('Attualmente') }}: {{ "{$product->destination?->name}, {$product->destination?->province}" }}
                            </x-slot:hint>
                        @endif
                    </x-gmaps>
                    <x-gmaps label="{!! __('Punto d\'incontro') !!}" name="gmaps_point" :types="['address']">
                        <x-slot:prepend>
                            <x-heroicon-o-magnifying-glass
                                class="w-5 h-5 text-627277"/>
                        </x-slot:prepend>
                        @if($product->meeting_point)
                            <x-slot:hint>
                                {{ __('Attualmente') }}: <a href="{{ $product->getGoogleMapsLink() }}" target="_blank" class="text-00abc0 underline">{{ "{$product->meeting_point}" }}</a>
                            </x-slot:hint>
                        @endif
                    </x-gmaps>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 6 || $form->product->temporary_step === 6)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Parole chiave') }}</x-slot:title>
                    <x-slot:content_title>{{ __('Aggiungi delle parole chiave al tuo prodotto (facoltativo)') }}</x-slot:content_title>
                    <x-slot:content_subtitle>{{ __('Le parole chiave funzionano come tag per la tua attività e aiutano i clienti a trovarla quando effettuano ricerche in base ai loro interessi.') }}</x-slot:content_subtitle>
                    <div class="text-xs text-627277">
                        <h5 class="font-semibold">{{ __('Le parole chiave dovrebbero rispondere a domande come:') }}</h5>
                        <ul class="list-disc list-inside space-y-0.5 mt-1">
                            <li>{{ __('Qual è il tema generale della tua attività? (Crociera sul fiume? Degustazione di vini?') }}</li>
                            <li>{{ __('Succede in un momento particolare? (Tramonto? Notte? Natale? Primavera?') }}</li>
                            <li>{{ __('Su quale argomento ti concentri? (Arte medievale? Storia antica? Cibo di strada?') }}</li>
                            <li>{{ __('Per chi è? (Per famiglie? Per bambini? Solo per adulti?') }}</li>
                        </ul>
                    </div>
                    <x-tags wire:model="form.keywords"/>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 7 || $form->product->temporary_step === 7)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Incluso ed escluso') }}</x-slot:title>
                    <x-slot:content_title>{{ __('Cos\'è incluso nel prodotto?') }}</x-slot:content_title>
                    <x-slot:content_subtitle>{!! __('Seleziona tutte le principali funzionalità incluse nel prezzo.<br/>Ciò consente ai clienti di vedere il rapporto qualità-prezzo per questo prodotto.') !!}</x-slot:content_subtitle>
                    <div>
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Cibo') }}</h5>
                        <div class="divide-y">
                            @foreach(config('tripsytour.services.food') as $k => $item)
                                <div class="py-2.5">
                                    <x-checkbox
                                        wire:key="{{ $k }}"
                                        wire:change="updateIncludedService('food', '{{$k}}')"
                                        :checked="array_key_exists($k, $form->incl_services)"
                                        value="{{ $k }}"
                                    >
                                        {{ __($item['label']) }}
                                    </x-checkbox>
                                    @if(array_key_exists($k, $form->incl_services))
                                        <div class="py-2.5 ml-7 space-y-2">
                                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Quali restrizioni dietetiche/allergiche puoi soddisfare?') }}</h5>
                                            <div class="columns-4">
                                                @foreach(config('tripsytour.services.restrictions') as $kk => $ii)
                                                    <x-checkbox
                                                        wire:key="{{ $kk }}"
                                                        wire:model.live="form.incl_services.{{$k}}.restrictions"
                                                        value="{{ $kk }}"
                                                    >
                                                        {{ __($ii['label']) }}
                                                    </x-checkbox>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Personale') }}</h5>
                        <div class="divide-y">
                            @foreach(config('tripsytour.services.staff') as $k => $item)
                                <div class="py-2.5">
                                    <x-checkbox
                                        wire:key="{{ $k }}"
                                        wire:change="updateIncludedService('staff', '{{$k}}')"
                                        :checked="array_key_exists($k, $form->incl_services)"
                                        value="{{ $k }}"
                                    >
                                        {{ __($item['label']) }}
                                    </x-checkbox>
                                    @if(array_key_exists($k, $form->incl_services))
                                        <div class="py-2.5 ml-7 space-y-2">
                                            <h5 class="text-sm text-0d171a font-semibold">{{ __('In quale lingua è disponibile il servizio?') }}</h5>
                                            <div class="columns-4">
                                                @foreach(config('tripsytour.services.languages') as $kk => $ii)
                                                    <x-checkbox
                                                        wire:key="{{ $kk }}"
                                                        wire:model.live="form.incl_services.{{$k}}.languages"
                                                        value="{{ $kk }}"
                                                    >
                                                        {{ __($ii) }}
                                                    </x-checkbox>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 8 || $form->product->temporary_step === 8)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Servizi aggiuntivi') }}</x-slot:title>
                    <x-slot:content_title>{{ __('Seleziona i servizi aggiuntivi che l\'utente potrà aggiungere all\'attività') }}</x-slot:content_title>
                    <x-slot:content_subtitle>{{ __('Una volta selezionati potrai personalizzarli andando a definire i dettagli') }}</x-slot:content_subtitle>
                    <div>
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Cibo') }}</h5>
                        <div class="divide-y">
                            @foreach(config('tripsytour.services.food') as $k => $item)
                                <div class="py-2.5">
                                    <x-checkbox
                                        wire:key="{{ $k }}"
                                        wire:change="updateExtraService('food', '{{$k}}')"
                                        :checked="array_key_exists($k, $form->extr_services)"
                                        value="{{ $k }}"
                                    >
                                        {{ __($item['label']) }}
                                    </x-checkbox>
                                    @if(array_key_exists($k, $form->extr_services))
                                        <div class="py-2.5 ml-7 space-y-2">
                                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Quali restrizioni dietetiche/allergiche puoi soddisfare?') }}</h5>
                                            <div class="columns-4">
                                                @foreach(config('tripsytour.services.restrictions') as $kk => $ii)
                                                    <x-checkbox
                                                        wire:key="{{ $kk }}"
                                                        wire:model.live="form.extr_services.{{$k}}.restrictions"
                                                        value="{{ $kk }}"
                                                    >
                                                        {{ __($ii['label']) }}
                                                    </x-checkbox>
                                                @endforeach
                                            </div>
                                            <x-input
                                                wire:model="form.extr_services.{{$k}}.price"
                                                type="number" label="{{ __('Prezzo del servizio (a persona)') }}"
                                            />
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Trasporto') }}</h5>
                        <div class="divide-y">
                            @foreach(config('tripsytour.services.transports') as $k => $item)
                                <div class="py-2.5">
                                    <x-checkbox
                                        wire:key="{{ $k }}"
                                        wire:change="updateExtraService('transports', '{{$k}}')"
                                        :checked="array_key_exists($k, $form->extr_services)"
                                        value="{{ $k }}"
                                    >
                                        {{ __($item['label']) }}
                                    </x-checkbox>
                                    @if(array_key_exists($k, $form->extr_services))
                                        <div class="py-2.5 ml-7 space-y-2">
                                            <x-input
                                                wire:model="form.extr_services.{{$k}}.price"
                                                type="number" label="{{ __('Prezzo del servizio (a persona)') }}"
                                            />
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Accessori') }}</h5>
                        <div class="divide-y">
                            @foreach(config('tripsytour.services.accessories') as $k => $item)
                                <div class="py-2.5">
                                    <x-checkbox
                                        wire:key="{{ $k }}"
                                        wire:change="updateExtraService('transports', '{{$k}}')"
                                        :checked="array_key_exists($k, $form->extr_services)"
                                        value="{{ $k }}"
                                    >
                                        {{ __($item['label']) }}
                                    </x-checkbox>
                                    @if(array_key_exists($k, $form->extr_services))
                                        <div class="py-2.5 ml-7 space-y-2">
                                            <x-input
                                                wire:model="form.extr_services.{{$k}}.price"
                                                type="number" label="{{ __('Prezzo del servizio (a persona)') }}"
                                            />
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Personale') }}</h5>
                        <div class="divide-y">
                            @foreach(config('tripsytour.services.staff') as $k => $item)
                                <div class="py-2.5">
                                    <x-checkbox
                                        wire:key="{{ $k }}"
                                        wire:change="updateExtraService('staff', '{{$k}}')"
                                        :checked="array_key_exists($k, $form->extr_services)"
                                        value="{{ $k }}"
                                    >
                                        {{ __($item['label']) }}
                                    </x-checkbox>
                                    @if(array_key_exists($k, $form->extr_services))
                                        <div class="py-2.5 ml-7 space-y-2">
                                            <h5 class="text-sm text-0d171a font-semibold">{{ __('In quale lingua è disponibile il servizio?') }}</h5>
                                            <div class="columns-4">
                                                @foreach(config('tripsytour.services.languages') as $kk => $ii)
                                                    <x-checkbox
                                                        wire:key="{{ $kk }}"
                                                        wire:model.live="form.extr_services.{{$k}}.languages"
                                                        value="{{ $kk }}"
                                                    >
                                                        {{ __($ii) }}
                                                    </x-checkbox>
                                                @endforeach
                                            </div>
                                            <x-input
                                                wire:model="form.extr_services.{{$k}}.price"
                                                type="number" label="{{ __('Prezzo del servizio (a persona)') }}"
                                            />
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 9 || $form->product->temporary_step === 9)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Informazioni per i clienti') }}</x-slot:title>
                    <x-slot:content_subtitle>{{ __('Quali informazioni devono assolutamente sapere i clienti prima di scegliere di prenotare?') }}</x-slot:content_subtitle>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('A chi non è adatta questa attività? (facoltativo)') }}</h5>
                            <p class="text-xs text-627277">{!! __('Aggiungi un tag se la tua attività non è adatta alle restrizioni di alcune persone per motivi di sicurezza.<br/>Queste informazioni vengono visualizzate nella pagina dei dettagli dell\'attività.') !!}</p>
                        </div>
                        <div class="text-xs text-0d171a bg-eff4f5 p-2">
                            <h5 class="font-semibold">{{ __('Esempi') }}:</h5>
                            <ul class="space-y-0.5 mt-1">
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Donne incinta') }}</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Persone sotto i 120cm') }}</span>
                                </li>
                            </ul>
                        </div>
                        <x-tags wire:model="form.not_suitable"/>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Cosa non è consentito? (facoltativo)') }}</h5>
                            <p class="text-xs text-627277">{{ __('Elenca qualsiasi oggetto, abbigliamento o azione non consentita nella tua attività.') }}</p>
                        </div>
                        <div class="text-xs text-0d171a bg-eff4f5 p-2">
                            <h5 class="font-semibold">{{ __('Esempi') }}:</h5>
                            <ul class="space-y-0.5 mt-1">
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Fotografare') }}</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Camicie senza maniche') }}</span>
                                </li>
                            </ul>
                        </div>
                        <x-tags wire:model="form.not_allowed"/>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Quali oggetti obbligatori deve portare con sé il cliente? (facoltativo)') }}</h5>
                            <p class="text-xs text-627277">{!! __('Queste informazioni vengono visualizzate nella pagina dei dettagli dell\'attività e nel voucher.') !!}</p>
                        </div>
                        <div class="text-xs text-0d171a bg-eff4f5 p-2">
                            <h5 class="font-semibold">{{ __('Esempi') }}:</h5>
                            <ul class="space-y-0.5 mt-1">
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Documento d\'identità o Passaporto') }}</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Asciugamano') }}</span>
                                </li>
                            </ul>
                        </div>
                        <x-tags wire:model="form.mandatory_items"/>
                    </div>
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <h5 class="text-sm text-0d171a font-semibold">{{ __('Informazioni prima della prenotazione (facoltativo)') }}</h5>
                            <p class="text-xs text-627277">{!! __('Aggiungi tutte le informazioni rimanenti che i clienti devono conoscere prima di prenotare.<br/>Queste informazioni vengono visualizzate nella pagina dei dettagli dell\'attività.') !!}</p>
                        </div>
                        <div class="text-xs text-0d171a bg-eff4f5 p-2">
                            <h5 class="font-semibold">{{ __('Esempi') }}:</h5>
                            <ul class="space-y-0.5 mt-1">
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Tutti i visitatori devono passare attraverso i controlli di sicurezza in stile aeroportuale') }}</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <x-heroicon-o-check class="w-3 h-3 text-259332"/>
                                    <span>{{ __('Questo tour avrà luogo con la pioggia o con il sole') }}</span>
                                </li>
                            </ul>
                        </div>
                        <x-textarea
                            wire:model="form.preliminary_informations"
                            class="resize-none"
                            maxlength="1000"
                            hint="counter"
                        />
                    </div>
                    <div class="space-y-3">
                        <h5 class="text-sm text-0d171a font-semibold">{{ __('Domande Frequenti (facoltativo)') }}</h5>
                        <p class="text-xs text-627277">{!! __('Aggiungi tutte le domande che vengono più frequentemente poste dai clienti.<br/>Queste informazioni vengono visualizzate nella pagina dei dettagli dell\'attività.') !!}</p>
                        <div class="divide-y divide-e2eaeb">
                            @foreach($form->faqs as $k => $faq)
                                <div x-data="{open: false}" x-init="'{{$faq['title']}}' === '' ? open = true : open = false" class="py-3">
                                    <div x-on:click="open = !open" class="flex items-center justify-between hover:cursor-pointer">
                                        <h4 class="text-sm font-medium text-0d171a">{{ $faq['title'] }}</h4>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                wire:confirm="{{ __('Sei sicuro di voler elminare questa FAQ?') }}"
                                                wire:click="removeFaq({{ $k }})"
                                                class="grid place-items-center w-6 h-6 text-e57868 bg-e57868/20 rounded hover:cursor-pointer hover:text-white hover:bg-e57868">
                                                <x-heroicon-o-trash class="w-4 h-4 shrink-0"/>
                                            </div>
                                            <div
                                                class="grid place-items-center w-6 h-6 text-ffa14a bg-fff2e6 rounded hover:cursor-pointer hover:text-white hover:bg-ffa14a">
                                                <x-heroicon-o-pencil class="w-4 h-4 shrink-0"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="open" class="mt-3 space-y-3">
                                        <x-input wire:model="form.faqs.{{$k}}.title" label="Domanda"></x-input>
                                        <x-textarea wire:model="form.faqs.{{$k}}.content" label="Risposta"></x-textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-tripsy-button color="orange" wire:click="addFaq">
                            Aggiungi
                        </x-tripsy-button>
                    </div>
                    <div>
                        <h3 class="text-2xl text-0d171a font-semibold">{{ __('Prima delle attività') }}</h3>
                        <div class="space-y-3">
                            <div class="space-y-1">
                                <h5 class="text-sm text-0d171a font-semibold">{{ __('Come possono i clienti contattarvi in caso di emergenza? (facoltativo)') }}</h5>
                                <p class="text-xs text-627277">{!! __('Queste informazioni vengono visualizzate nel voucher.') !!}</p>
                            </div>
                            <x-input wire:model="form.contact" label="{{ __('Cellulare') }}"
                                     placeholder="Es: +393498572084"/>
                        </div>
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 10 || $form->product->temporary_step === 10)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Foto') }}</x-slot:title>
                    <x-slot:content_subtitle>{{ __('Carica foto pertinenti e coinvolgenti per aumentare potenzialmente il tuo tasso di conversione in media del 2.7%, in altre parole, per aumentare le tue prenotazioni e i tuoi guadagni.') }}</x-slot:content_subtitle>
                    <div class="space-y-3">
                        <livewire:dropzone
                            wire:model="form.uploaded_images"
                            :rules="['image','mimes:png,jpg,jpeg','max:4096']"
                            multiple
                        >
                        </livewire:dropzone>
                        <x-input-error for="form.uploaded_images"></x-input-error>
                    </div>
                    <div class="grid grid-cols-6 gap-3">
                        @foreach($product->images as $image)
                            <div
                                class="col-span-3 grid place-items-center border rounded overflow-hidden sm:col-span-2 lg:col-span-1">
                                <img src="{{ Storage::url($image->path) }}" alt="" class="w-28 h-28 object-cover">
                                <div
                                    wire:click="deleteImage({{$image->id}})"
                                    class="group place-self-stretch py-1 text-center bg-white hover:cursor-pointer"
                                >
                                    <div
                                        class="flex items-center justify-center space-x-1 text-xs text-e57868 font-semibold group-hover:text-red-500">
                                        <x-heroicon-o-x-mark class="w-4 h-4"/>
                                        <span>{{ __('Elimina') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 11 || $form->product->temporary_step === 11)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Gestione prenotazione') }}</x-slot:title>
                    <x-slot:content_subtitle>{{ __('Scegli la modalità per la gestione delle tue prenotazioni relative a questo prodotto') }}</x-slot:content_subtitle>
                    <div class="space-y-3">
                        @foreach(config('tripsytour.product.booking_types') as $k => $item)
                            <x-radio
                                wire:key="{{ $k }}"
                                wire:model.live="form.booking_type"
                                value="{{ $k }}"
                            >
                                {{ __($item['label']) }}
                                <x-slot:description>
                                    {{ __($item['description']) }}
                                </x-slot:description>
                            </x-radio>
                        @endforeach
                        <x-input-error for="form.booking_type"></x-input-error>
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 12 || $form->product->temporary_step === 12)
                <x-product-create-card :item="$form->product">
                    <x-slot:title>{{ __('Metodo di pagamento') }}</x-slot:title>
                    <x-slot:content_subtitle>{!! __('Scegli la modalità per ricevere il pagamento dai clienti.<br/>È possibile selezionare più di un\'opzione') !!}</x-slot:content_subtitle>
                    <div class="space-y-3">
                        @foreach(config('tripsytour.product.payment_types') as $k => $item)
                            <x-radio
                                wire:key="{{ $k }}"
                                wire:model="form.payment_type"
                                value="{{ $k }}"
                            >
                                {{ __($item['label']) }}
                                <x-slot:description>
                                    {{ __($item['description']) }}
                                </x-slot:description>
                            </x-radio>
                        @endforeach
                        <x-input-error for="form.payment_type"></x-input-error>
                    </div>
                </x-product-create-card>
            @endif
            @if($form->product->current_step === 13 && !$form->product->temporary_step)
                <x-product-create-card :item="$form->product" :stepper="false">
                    <x-slot:title>{{ __('Review') }}</x-slot:title>
                    <x-slot:content_subtitle>{!! __('Controlla come apparirà la tua attività su :appname prima di pubblicarla. Assicurati che tutto sia corretto.<br/>Quindi salva e pubblica la tua attività una volta che sei soddisfatto che tutto sia pronto.', ['appname' => env('APP_NAME')]) !!}</x-slot:content_subtitle>
                    <div class="space-y-3">
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Informazioni di base') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item title="{{ __('Categoria prodotto') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(1)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->category->name }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Tipologia prodotto') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(2)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->typology->name }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Titolo') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(3)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->name }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Presenta il tuo prodotto') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->description }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Cancellazione') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ config("tripsytour.cancellations.{$product->cancellation}.label") }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Durata') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ trans_choice('{1} :count ora|[2,*] :count ore', $product->duration) }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Difficoltà') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ config('tripsytour.difficulties.'.$product->difficulty) }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Animali') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->pets_allowed ? __('Animali ammessi') : __('Animali non ammessi') }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Accessibilità') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->accessibility ? __('Accessibile a persone con disabilità') : __('Non accessibile a persone con disabilità') }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{!! __('Personale d\'accoglienza') !!}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(4)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->reception_staff_languages }}
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Località') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item title="{!! __('Luogo dell\'attività') !!}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(5)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->destination->name }}, {{ $product->destination->province }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{!! __('Punto d\'incontro') !!}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(5)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->meeting_point ?: '-' }}
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Keywords') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item>
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(6)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->keywords_list }}
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Cosa è incluso') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item>
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(7)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <ul class="*:text-0d171a *:text-sm space-y-1 *:py-2 *:border-t border-e2eaeb w-full">
                                                @foreach($product->included_services as $service)
                                                    <li class="{{ $loop->first ? '!border-t-0' : '' }}">
                                                        <div>
                                                            <h5 class="text-sm leading-none text-0d171a">
                                                                {{ $service->name }}
                                                            </h5>
                                                            <p class="text-xs text-627277 leading-normal">
                                                                {!! $service->description !!}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Servizi aggiuntivi') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item>
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(8)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <ul class="*:text-0d171a *:text-sm space-y-1 *:py-2 *:border-t border-e2eaeb w-full">
                                                @foreach($product->extra_services as $service)
                                                    <li class="{{ $loop->first ? '!border-t-0' : '' }}">
                                                        <div>
                                                            <h5 class="text-sm leading-none text-0d171a">
                                                                {{ $service->name }}
                                                                - {{ money($service->price, forceDecimals: true) }} {{ $service->price_type }}
                                                            </h5>
                                                            <p class="text-xs text-627277 leading-normal">
                                                                {!! $service->description !!}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span
                                    class="text-sm font-semibold text-1e2e33">{{ __('Informazioni per i clienti') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item title="{{ __('A chi non è adatta questa attività') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(9)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <ul class="*:text-0d171a *:text-sm space-y-1 *:py-2 *:border-t border-e2eaeb w-full">
                                                @forelse((array)$product->not_suitable as $item)
                                                    <li class="{{ $loop->first ? '!border-t-0' : '' }}">
                                                        <div>
                                                            <h5 class="text-sm leading-none text-0d171a">
                                                                {{ $item }}
                                                            </h5>
                                                        </div>
                                                    </li>
                                                @empty
                                                    -
                                                @endforelse
                                            </ul>
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Cosa non è consentito') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(9)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <ul class="*:text-0d171a *:text-sm space-y-1 *:py-2 *:border-t border-e2eaeb w-full">
                                                @forelse((array)$product->not_allowed as $item)
                                                    <li class="{{ $loop->first ? '!border-t-0' : '' }}">
                                                        <div>
                                                            <h5 class="text-sm leading-none text-0d171a">
                                                                {{ $item }}
                                                            </h5>
                                                        </div>
                                                    </li>
                                                @empty
                                                    -
                                                @endforelse
                                            </ul>
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Oggetti obbligatori') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(9)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <ul class="*:text-0d171a *:text-sm space-y-1 *:py-2 *:border-t border-e2eaeb w-full">
                                                @forelse((array)$product->mandatory_items as $item)
                                                    <li class="{{ $loop->first ? '!border-t-0' : '' }}">
                                                        <div>
                                                            <h5 class="text-sm leading-none text-0d171a">
                                                                {{ $item }}
                                                            </h5>
                                                        </div>
                                                    </li>
                                                @empty
                                                    -
                                                @endforelse
                                            </ul>
                                        </x-partials.review-item>
                                        <x-partials.review-item
                                            title="{{ __('Informazioni prima della prenotazione') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(9)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->preliminary_informations ?: '-' }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('Contatto di emergenza') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(9)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ $product->contact ?: '-' }}
                                        </x-partials.review-item>
                                        <x-partials.review-item title="{{ __('FAQs') }}">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(9)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ trans_choice(':count FAQ presente|[2,*] :count FAQs presenti', $product->faqs->count()) }}
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Foto') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item class="!grid-cols-1">
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(10)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <div class="grid grid-cols-6 gap-3">
                                                @forelse($product->images as $image)
                                                    <div
                                                        class="col-span-3 grid place-items-center border rounded overflow-hidden sm:col-span-2 lg:col-span-1">
                                                        <img src="{{ Storage::url($image->path) }}" alt=""
                                                             class="w-28 h-28 object-cover">
                                                    </div>
                                                @empty
                                                    -
                                                @endforelse
                                            </div>
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Gestione prenotazione') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item>
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(11)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            {{ config("tripsytour.product.booking_types.{$product->booking_type}.label") }}
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between border-b border-e2eaeb py-3 hover:cursor-pointer">
                                <span class="text-sm font-semibold text-1e2e33">{{ __('Metodo di pagamento') }}</span>
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4">
                                <div class="border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        <x-partials.review-item>
                                            <x-slot:trigger>
                                                <x-heroicon-o-pencil
                                                    wire:click="setTemporaryStep(12)"
                                                    class="w-4 h-4"/>
                                            </x-slot:trigger>
                                            <div class="text-sm leading-none text-0d171a py-2 w-full">
                                                @if($product->payment_type)
                                                    <h5>
                                                        {{ config("tripsytour.product.payment_types.{$product->payment_type}.label") }}
                                                    </h5>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </x-partials.review-item>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-product-create-card>
            @endif

            <div
                @class([
                    'mt-8 flex items-center justify-between',
                    '!justify-end' => $form->product->temporary_step || $form->product->current_step === 1,
                ])>
                @if($form->product->current_step > 1 && !$form->product->temporary_step)
                    <x-tripsy-button wire:click="prev" color="gray">{{ __('Indietro') }}</x-tripsy-button>
                @endif
                <div class="flex space-x-2">
                    @if(!$form->product->temporary_step)
                        <x-tripsy-button wire:click="saveAndExit">{{ __('Salva ed esci') }}</x-tripsy-button>
                        @if($form->product->current_step === 13)
                            <x-tripsy-button
                                color="orange"
                                wire:click="next"
                                wire:loading.attr="disabled"
                            >
                                {{ __('Pubblica') }}
                            </x-tripsy-button>
                        @else
                            <x-tripsy-button
                                color="orange"
                                wire:click="next"
                                wire:loading.attr="disabled"
                            >
                                {{ __('Avanti') }}
                            </x-tripsy-button>
                        @endif
                    @else
                        <x-tripsy-button
                            color="orange"
                            wire:click="returnToReview"
                        >
                            {{ __('Torna alla review') }}
                        </x-tripsy-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
