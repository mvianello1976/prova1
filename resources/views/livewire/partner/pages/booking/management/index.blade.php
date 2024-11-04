<div>
    <div class="container space-y-8">
        <div class="border rounded bg-white p-8">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Gestione prenotazioni') }}</h3>
            <div class="mt-8">
                <div class="block">
                    <div class="border-b border-e2eaeb">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <span wire:click="$set('currentTab', 'approved')" class="{{ $currentTab === 'approved' ? 'border-006cbc text-006cbc' : 'border-transparent text-b0b7be hover:border-gray-300 hover:text-627277 hover:cursor-pointer' }} whitespace-nowrap border-b-2 py-1 px-1 text-sm font-medium">
                                    {{ __('Approvate') }}
                                </span>
                            <span wire:click="$set('currentTab', 'to_approve')" class="{{ $currentTab === 'to_approve' ? 'border-006cbc text-006cbc' : 'border-transparent text-b0b7be hover:border-gray-300 hover:text-627277 hover:cursor-pointer' }} whitespace-nowrap border-b-2 py-1 px-1 text-sm font-medium">
                                    {{ __('Da approvare') }}
                                @if($to_approve)
                                    <div class="ml-1 inline-grid place-items-center bg-00abc0 w-5 h-5 rounded-full text-white font-semibold text-xs">
                                        <span>{{ $to_approve }}</span>
                                    </div>
                                @endif
                            </span>
                            <span wire:click="$set('currentTab', 'canceled')" class="{{ $currentTab === 'canceled' ? 'border-006cbc text-006cbc' : 'border-transparent text-b0b7be hover:border-gray-300 hover:text-627277 hover:cursor-pointer' }} whitespace-nowrap border-b-2 py-1 px-1 text-sm font-medium">
                                    {{ __('Annullate') }}
                                </span>
                            {{--                            @foreach($tabs as $k => $tab)--}}
                            {{--                                <span wire:click="$set('currentTab', '{{ $k }}')" class="{{ $currentTab === $k ? 'border-006cbc text-006cbc' : 'border-transparent text-b0b7be hover:border-gray-300 hover:text-627277 hover:cursor-pointer' }} whitespace-nowrap border-b-2 py-1 px-1 text-sm font-medium">--}}
                            {{--                                    {{ __($tab) }}--}}
                            {{--                                </span>--}}
                            {{--                            @endforeach--}}
                        </nav>
                    </div>
                </div>
                <div class="mt-6 flex items-center space-x-4">
                    <div class="w-full max-w-sm">
                        <x-input wire:model.live="search" type="text" placeholder="{{ __('Cerca...') }}">
                            <x-slot:prepend>
                                <x-heroicon-o-magnifying-glass class="w-5 h-5"/>
                            </x-slot:prepend>
                        </x-input>
                    </div>
                    <div class="w-full max-w-sm">
                        <x-b2b-datepicker wire:model.live="date" autoclose>
                            <x-slot:title>{{ __('Seleziona data') }}</x-slot:title>
                            <x-slot:icon>
                                <x-heroicon-o-calendar class="w-5 h-5"/>
                            </x-slot:icon>
                        </x-b2b-datepicker>
                    </div>
                    <div class="w-full max-w-sm">
                        <x-select wire:model.live="payment_status">
                            <option value="">{{ __('Stato pagamento') }}</option>
                            @foreach(config('tripsytour.order.payment_statuses') as $k => $status)
                                <option value="{{ $k }}">{{ __($status) }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-e2eaeb">
                                <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-2 pl-4 pr-3 text-left text-xs font-semibold text-b0b7be sm:pl-0">
                                        {{ __('ID Prenotazione') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Nome') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Email') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Cellulare') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Attività') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Data attività') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Partecipanti') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Stato pagamento') }}
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                        {{ __('Stato approvazione') }}
                                    </th>
                                    <th scope="col" class="relative py-2 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">{{ __('Azioni') }}</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a uppercase sm:pl-0">{{ $order->uuid }}</td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $order->user->full_name }}</td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $order->user->email }}</td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $order->user->mobile ?: '-' }}</td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $order->data['product']['name'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $order->data['booking']['date'])->format('d/m/Y') }}</td>
                                        <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $order->data['booking']['participants']['total'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                            @switch($order->payment_status)
                                                @case('unpaid')
                                                    <span class="px-1.5 py-0.5 text-xs font-medium rounded bg-fcebf5 text-e568b5">{{ config('tripsytour.order.payment_statuses.'.$order->payment_status) }}</span>
                                                    @break
                                                @case('paid')
                                                    <span class="px-1.5 py-0.5 text-xs font-medium rounded bg-e6ffe7 text-67b26a">{{ config('tripsytour.order.payment_statuses.'.$order->payment_status) }}</span>
                                                    @break
                                                @case('canceled')
                                                    <span class="px-1.5 py-0.5 text-xs font-medium rounded bg-fff2e6 text-ffa14a">{{ config('tripsytour.order.payment_statuses.'.$order->payment_status) }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                            @switch($order->status)
                                                @case('to_approve')
                                                    <span class="px-1.5 py-0.5 text-xs font-medium rounded bg-fcebf5 text-e568b5">{{ config('tripsytour.order.statuses.'.$order->status) }}</span>
                                                    @break
                                                @case('approved')
                                                    <span class="px-1.5 py-0.5 text-xs font-medium rounded bg-e6ffe7 text-67b26a">{{ config('tripsytour.order.statuses.'.$order->status) }}</span>
                                                    @break
                                                @case('canceled')
                                                    <span class="px-1.5 py-0.5 text-xs font-medium rounded bg-fff2e6 text-ffa14a">{{ config('tripsytour.order.statuses.'.$order->status) }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="flex justify-end relative whitespace-nowrap py-4 pl-3 text-right text-xs font-medium">
                                            <div class="flex items-center space-x-1">
                                                <a href="{{ route('bookings.management.show', $order->id) }}" class="bg-defbff text-006cbc py-1 px-1 rounded hover:text-white hover:cursor-pointer hover:bg-00abc0">
                                                    <x-heroicon-o-eye class="w-4 h-4"/>
                                                </a>
                                                {{--                                                <div class="bg-d3ecff text-006cbc py-1 px-1 rounded hover:text-white hover:cursor-pointer hover:bg-006cbc">--}}
                                                {{--                                                    <x-heroicon-o-printer class="w-4 h-4"/>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="whitespace-nowrap py-4 text-xs text-center text-0d171a">{{ __('Nessun ordine presente') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
