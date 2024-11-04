<div>
    <div class="container space-y-8">
        <div class="border rounded bg-white p-8 space-y-6">
            <a href="{{ route('availabilities.index') }}" class="flex items-center space-x-2 text-b0b7be text-xs">
                <x-heroicon-o-chevron-left class="w-3 h-3"/>
                <span>{{ __('Indietro') }}</span>
            </a>
            <h3 class="text-2xl text-0d171a font-semibold">
                <span>{{ $availability->product->name }}</span>
                <div class="inline-block text-lg font-normal">
                    <span>-</span>
                    <span>{{ $availability->product->typology->name }}</span>
                </div>
            </h3>
            <div class="space-y-3">
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden ring-1 ring-black ring-opacity-5 sm:rounded">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-03b8ce">
                                    <tr>
                                        <th scope="col" class="py-2.5 pl-2 pr-3 text-left text-xs font-semibold text-white">
                                            {{ __('Periodi') }}
                                        </th>
                                        <th scope="col" class="px-3 py-2.5 text-left text-xs font-semibold text-white">
                                            {{ __('Orari') }}
                                        </th>
                                        <th scope="col" class="px-3 py-2.5 text-left text-xs font-semibold text-white">
                                            {{ __('Partenza ogni') }}
                                        </th>
                                        <th scope="col" class="px-3 py-2.5 text-left text-xs font-semibold text-white">
                                            {{ __('Capienza') }}
                                        </th>
                                        <th scope="col" class="px-3 py-2.5 text-left text-xs font-semibold text-white">
                                            {{ __('Costo') }}
                                        </th>
                                        <th scope="col" class="relative text-xs font-semibold text-white py-3.5 pl-2 pr-4 sm:pr-6">
                                            {{ __('Azioni') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($dates as $date)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-2 pr-3 text-xs font-medium text-gray-900">
                                                {{ "{$date->date_start->format('d/m/Y')} - {$date->date_end->format('d/m/Y')}" }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                {{ "{$date->time_start->format('H:i')} - {$date->time_end->format('H:i')}" }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                {{ $date->step }} {{ __('minuti') }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                {{ $date->participants_per_time ?: '-' }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">
                                                @if(!$availability->product->isRental())
                                                    <div class="flex items-center space-x-1">
                                                        <span class="px-1.5 py-0.5 text-xs text-0d171a rounded bg-d3ecff">{{ money($date->adults_price, forceDecimals: true) }}/{{ __('adulto') }}</span>
                                                        <span class="px-1.5 py-0.5 text-xs text-0d171a rounded bg-defbff">{{ money($date->kids_price, forceDecimals: true) }}/{{ __('ragazzo') }}</span>
                                                        <span class="px-1.5 py-0.5 text-xs text-0d171a rounded bg-e8faed">{{ money($date->children_price, forceDecimals: true) }}/{{ __('bambino') }}</span>
                                                    </div>
                                                @else
                                                    <span class="px-1.5 py-0.5 text-xs text-0d171a rounded bg-d3ecff">{{ money($date->rental_total_price, forceDecimals: true) }}/{{ __('mezzo') }}</span>
                                                @endif
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 text-right text-xs font-medium">
                                                <div class="flex items-center space-x-1">
                                                    <div wire:click="$dispatch('openModal', {component: 'partner.pages.availability.modals.edit-availability', arguments: {availability_date: {{ $date->id }}}})" class="bg-fff2e6 text-ffa14a py-1 px-1 rounded hover:cursor-pointer hover:text-white hover:bg-ffa14a">
                                                        <x-heroicon-o-pencil class="w-4 h-4 shrink-0"/>
                                                    </div>
                                                    <div wire:click="$dispatch('openModal', {component: 'partner.pages.availability.modals.delete-availability', arguments: {availability_date: {{ $date->id }}}})" class="bg-fff2e6 text-e57868 py-1 px-1 rounded hover:text-white hover:cursor-pointer hover:bg-e57868">
                                                        <x-heroicon-o-trash class="w-4 h-4"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <span wire:click="$dispatch('openModal', { component: 'partner.pages.availability.modals.add-availability', arguments: {availability: {{ $availability->id }} }})" class="!mt-5 inline-flex items-center space-x-1 text-sm text-03b8ce font-semibold hover:cursor-pointer">
                    <x-heroicon-o-plus class="w-4 h-4"/>
                    <span>{{ __('Aggiungi disponibilità') }}</span>
                </span>
            </div>
        </div>
    </div>
</div>
