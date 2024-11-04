<div class="max-w-6xl mx-auto py-10">
    <div class="flex items-center justify-between mb-8">
        {{-- TODO: Link al profilo B2C - tab Prenotazioni --}}
        <a href="{{ route('guest.profile.show') }}" class="flex items-center space-x-2 text-b0b7be text-xs">
            <x-heroicon-o-chevron-left class="w-3 h-3"/>
            <span>{{ __('Indietro') }}</span>
        </a>
        <div class="flex items-center divide-x">
            <a x-data x-on:click="window.print()" class="flex items-center space-x-1.5 text-b0b7be text-xs px-3 hover:cursor-pointer hover:text-00abc0">
                <x-heroicon-o-printer class="w-3 h-3"/>
                <span>{{ __('Stampa') }}</span>
            </a>
            <a wire:click="download" class="flex items-center space-x-1.5 text-b0b7be text-xs px-3 hover:cursor-pointer hover:text-00abc0">
                <x-heroicon-o-arrow-down-tray class="w-3 h-3"/>
                <span>{{ __('Scarica') }}</span>
            </a>
        </div>
    </div>
    <div class="space-y-4">
        @foreach($order->tickets as $ticket)
            <div class="grid grid-cols-12 divide-x divide-dashed bg-white border border-e2eaeb rounded-xl overflow-hidden">
                <div class="col-span-10 p-5">
                    <h3 class="font-medium text-0d171a space-x-0.5">
                        <span>{{ $order->data['product']['name'] }}</span>
                        <span class="text-gray-300 text-sm">-</span>
                        <span class="text-gray-400 text-xs">{{ $order->data['product']['destination'] }}</span>
                        <span class="text-gray-300 text-sm">/</span>
                        <span class="text-gray-400 text-xs">{{ $order->data['product']['typology'] }}</span>
                    </h3>
                    <hr class="mt-2">
                    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-xs font-semibold text-627277">{{ __('Data prenotazione') }}</dt>
                        <dd class="mt-1 text-xs font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $order->data['booking']['date'])->format('d/m/Y') }}</dd>
                    </div>
                    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-xs font-semibold text-627277">{{ __('Orario') }}</dt>
                        <dd class="mt-1 text-xs font-medium text-0d171a sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::createFromFormat('H:i:s', $order->data['booking']['time'])->format('H:i') }}</dd>
                    </div>
                    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-xs font-semibold text-627277">{{ __('Durata') }}</dt>
                        <dd class="mt-1 text-xs font-medium text-0d171a sm:col-span-2 sm:mt-0">
                            {{ trans_choice('{1} :count ora|[2,*] :count ore', $order->data['booking']['duration']) }}
                        </dd>
                    </div>
                    <hr class="mt-2">
                    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-xs font-semibold text-627277">{{ __('ID Ordine') }}</dt>
                        <dd class="mt-1 text-xs font-medium text-0d171a sm:col-span-2 sm:mt-0 uppercase">{{ $order->uuid }}</dd>
                    </div>
                    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-xs font-semibold text-627277">{{ __('Metodo di pagamento') }}</dt>
                        <dd class="mt-1 text-xs font-medium text-0d171a sm:col-span-2 sm:mt-0">
                            {{ config("tripsytour.order.payment_methods.{$order->payment_method}") }}
                        </dd>
                    </div>
                </div>
                <div class="col-span-2 flex flex-col items-center">
                    <img src="{{ \App\Helpers\generateQrCode($ticket->encrypted) }}" class="w-full max-w-[200px] shrink-0">
                    <span class="block text-0d171a mb-3 font-mono uppercase">{{ $ticket->uuid }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
