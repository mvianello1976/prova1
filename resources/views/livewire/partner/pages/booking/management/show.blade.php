<div>
    <div class="container space-y-8">
        <div class="border rounded bg-white p-8 space-y-6 print:border-none print:space-y-3 print:p-0">
            <a href="{{ route('bookings.management.index') }}" class="flex items-center space-x-2 text-b0b7be text-xs print:hidden">
                <x-heroicon-o-chevron-left class="w-3 h-3"/>
                <span>{{ __('Indietro') }}</span>
            </a>
            <h3 class="text-2xl text-0d171a font-semibold">
                <span>{{ $order->data['product']['name'] }}</span>
                <div class="inline-block text-lg font-normal">
                    <span>-</span>
                    <span>{{ $order->data['product']['typology'] }}</span>
                </div>
            </h3>
            <div class="space-y-3">
                <div class="flex items-center space-x-2 print:hidden">
                    @if(!$order->canceled_at)
                        <div wire:click="changeOrderStatus"
                             class="flex items-center text-sm space-x-2 font-medium py-1 px-1.5 rounded {{ $order->status === 'approved' ? 'text-white bg-67b26a' : 'text-67b26a bg-e6ffe7 hover:cursor-pointer hover:text-white hover:bg-67b26a' }}">
                            <x-heroicon-o-calendar class="w-4 h-4 shrink-0"/>
                            @if($order->status === 'approved')
                                <span>{{ __('Approvato') }}</span>
                            @else
                                <span>{{ __('Approva') }}</span>
                            @endif
                        </div>
                        <div wire:click="$dispatch('openModal', {component: 'partner.pages.booking.management.modals.cancel-order', arguments: {order: {{$order->id}} }})"
                             class="flex items-center text-sm space-x-2 bg-fdebe8 text-e57868 font-medium py-1 px-1.5 rounded hover:cursor-pointer hover:text-white hover:bg-e57868">
                            <x-heroicon-o-x-mark class="w-4 h-4 shrink-0"/>
                            <span>{{ __('Annulla') }}</span>
                        </div>
                    @endif
                    <div x-data x-on:click="window.print()"
                         class="flex items-center text-sm space-x-2 bg-d3ecff text-006cbc font-medium py-1 px-1.5 rounded hover:cursor-pointer hover:text-white hover:bg-006cbc">
                        <x-heroicon-o-printer class="w-4 h-4 shrink-0"/>
                        <span>{{ __('Stampa') }}</span>
                    </div>
                </div>
                @if($order->canceled_at)
                    <div class="rounded-md bg-yellow-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">{{ __('Ordine annullato') }}</h3>
                                <p class="text-xs text-yellow-800">{{ __('L\'ordine è stato annullato in data') }} {{ $order->canceled_at->format('d/m/Y') }}</p>
                                <div class="mt-4 text-sm text-yellow-700">
                                    <h3 class="text-sm font-medium text-yellow-800">{{ __('Motivazione:') }}</h3>
                                    <p>{{ $order->canceled_reason }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="space-y-6 divide-y divide-e2eaeb">
                    <div class="py-3">
                        <h3 class="text-xl text-0d171a font-semibold">{{ __('Informazioni del cliente') }}</h3>
                        <dl>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Nome') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ $order->user->first_name }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Cognome') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ $order->user->last_name }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Email') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ $order->user->email }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Cellulare') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ $order->user->mobile ?: '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="py-3">
                        <h3 class="text-xl text-0d171a font-semibold">{{ __('Informazioni di pagamento') }}</h3>
                        <dl>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Stato pagamento') }}</dt>
                                <dd class="flex items-center mt-1 text-sm font-medium sm:col-span-2 sm:mt-0">
                                    @switch($order->payment_status)
                                        @case('unpaid')
                                            <span class="px-1.5 py-0.5 rounded bg-fcebf5 text-e568b5">{{ config("tripsytour.order.payment_statuses.{$order->payment_status}") }}</span>
                                            @break
                                        @case('paid')
                                            <span class="px-1.5 py-0.5 rounded bg-e6ffe7 text-67b26a">{{ config("tripsytour.order.payment_statuses.{$order->payment_status}") }}</span>
                                            <span class="text-xs text-627277 ml-1">({{ __('il :paid_at', ['paid_at' => $order->paid_at->format('d/m/Y H:i:s')]) }})</span>
                                            @break
                                        @case('canceled')
                                            <span class="px-1.5 py-0.5 rounded bg-fff2e6 text-ffa14a">{{ config("tripsytour.order.payment_statuses.{$order->payment_status}") }}</span>
                                            @break
                                    @endswitch
                                    @if($order->is_gift)
                                        <div
                                            x-data
                                            x-tooltip.raw="{{ $order->isReceivedGift() ? __('Regalo da :name', ['name' => $order->sender->fullname]) : __('Regalo a :name', ['name' => $order->gift_data['receiver_name']]) }}"
                                            class="ml-3 inline-grid place-items-center p-1.5 ring-1 ring-inset ring-ffa14a bg-orange-300 text-xs text-white font-semibold uppercase rounded-full hover:cursor-help">
                                            <x-heroicon-o-gift class="h-3.5 w-3.5 stroke-2"></x-heroicon-o-gift>
                                        </div>
                                    @endif
                                </dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('ID Ordine') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0 uppercase">{{ $order->uuid }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Metodo di pagamento') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">
                                    {{ config("tripsytour.order.payment_methods.{$order->payment_method}") }}
                                </dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Prezzo') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a space-x-2 sm:col-span-2 sm:mt-0">
                                    <span class="{{ $order->coupon ? 'text-627277 line-through' : '' }}">{{ money($order->data['booking']['total'], forceDecimals: true) }}</span>
                                    @if($order->coupon)
                                        <span>{{ money(max($order->total, 0), forceDecimals: true) }}</span>
                                    @endif
                                </dd>
                            </div>
                            @if($order->coupon)
                                <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                    <dt class="text-sm font-semibold text-627277">{{ __('Coupon applicato') }}</dt>
                                    <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">
                                        <span class="text-sm font-bold font-mono bg-gray-200 px-1 py-0.5 rounded-md mx-0.5">{{ $order->coupon['code'] }}</span>
                                        <span class="text-xs">
                                            @if($order->coupon['type'] === 'cash')
                                                (- {{ money($order->coupon['value'], forceDecimals: true) }})
                                            @elseif($order->coupon['type'] === 'percentage')
                                                (- {{ $order->coupon['value'] }}%)
                                            @endif
                                        </span>
                                    </dd>
                                </div>
                            @endif
                            @if($order->has_deposit)
                                <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                    <dt class="text-sm font-semibold text-627277">{{ __('Commissione :name', ['name' => env('APP_NAME')]) }}</dt>
                                    <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ money(max($order->deposit, 0), forceDecimals: true) }}</dd>
                                </div>
                            @endif
                            @if($order->payment_status === 'unpaid')
                                <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                    <dt class="text-sm font-semibold text-627277">{{ __('Ancora da pagare') }}</dt>
                                    <dd class="mt-1 text-sm font-medium text-0d171a space-x-3 sm:col-span-2 sm:mt-0">
                                        <span>{{ money(max(($order->total - $order->deposit), 0), forceDecimals: true) }}</span>
                                        @if(!$order->canceled_at || !$order->paid_at)
                                            <x-tripsy-button wire:click="setPaymentType" wire:confirm="{{ __('Sei sicuro di voler impostare lo stato del pagamento in \'Pagato\'?') }}" color="orange" class="!py-1.5 !px-4 print:hidden">
                                                {{ __('Pagamento effettuato') }}
                                            </x-tripsy-button>
                                        @endif
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                    <div class="py-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl text-0d171a font-semibold">{{ __('Informazioni della prenotazione') }}</h3>
                            @if(\Carbon\Carbon::parse($order->data['booking']['date'].' '.$order->data['booking']['time']) >= now())
                                <x-tripsy-button
                                    wire:click="$dispatch('openModal', { component: 'partner.modals.edit-order', arguments: { order: {{ $order->id }}}})"
                                    color="orange"
                                    class="print:hidden"
                                >
                                    {{ __('Modifica') }}
                                </x-tripsy-button>
                            @endif
                        </div>
                        <dl>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Attività') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ $order->data['product']['name'] }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Data prenotazione') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $order->data['booking']['date'])->format('d/m/Y') }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Orario') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::createFromFormat('H:i:s', $order->data['booking']['time'])->format('H:i') }}</dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Durata') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">
                                    {{ trans_choice('{1} :count ora|[2,*] :count ore', $order->data['booking']['duration']) }}
                                </dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Partecipanti') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">
                                    {{ $order->data['booking']['participants']['total'] }}
                                </dd>
                            </div>
                            <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 print:py-1">
                                <dt class="text-sm font-semibold text-627277">{{ __('Stato validazione biglietti') }}</dt>
                                <dd class="mt-1 text-sm font-medium text-0d171a sm:col-span-2 sm:mt-0">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($order->tickets as $ticket)
                                            <span class="px-1.5 py-0.5 rounded {{ $ticket->validated ? 'bg-67b26a text-white' : 'bg-ff7968 text-white' }} ">{{ $ticket->uuid }}</span>
                                        @endforeach
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
