<div>
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="border rounded bg-white p-8">
            <h3 class="text-2xl text-0d171a font-semibold">{{ __('Disponibilità') }}</h3>
            <div class="mt-8">
                <h5 class="text-sm text-0d171a font-semibold">{{ __('Seleziona le disponibilità delle tue attività, per rendere possibile ai clienti di prenotare.') }}</h5>
                <p class="text-xs text-627277">{{ __('Sono facili e veloci da configurare') }}</p>
                <x-tripsy-button
                    href="{{ route('availabilities.init.create') }}"
                    color="orange" class="mt-6">
                    {{ __('Crea nuova disponibilità') }}
                </x-tripsy-button>
            </div>
            <hr class="my-5">
            <div class="space-y-3">
                <h3 class="text-xl text-0d171a font-medium">{{ __('Disponibilità attive') }}</h3>
                <x-input
                    wire:model.live.debounce.200ms="search"
                    type="text" class="max-w-md" placeholder="{{ __('Cerca...') }}">
                    <x-slot:prepend>
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-627277"/>
                    </x-slot:prepend>
                </x-input>
                <div class="space-y-1">
                    @forelse($products as $product)
                        <div x-data="{ open: false }" x-bind:class="{'border rounded' : open}">
                            <div x-on:click="open = !open"
                                 class="flex items-center justify-between py-3 px-2 rounded hover:cursor-pointer hover:bg-gray-100" x-bind:class="{'bg-gray-100 rounded-b-none' : open}">
                                <span class="text-sm font-semibold text-1e2e33">{{ $product->name }}</span>
                                {{--                                <div--}}
                                {{--                                    class="px-1 py-1 rounded bg-defbff text-006cbc hover:cursor-pointer hover:text-white hover:bg-00abc0">--}}
                                {{--                                    <x-heroicon-o-eye class="w-4 h-4"/>--}}
                                {{--                                </div>--}}
                                <x-heroicon-o-chevron-right class="w-3 h-3 text-0d171a"
                                                            x-bind:class="{'rotate-90' : open}"></x-heroicon-o-chevron-right>
                            </div>
                            <div x-cloak x-show="open" class="space-y-4 mt-1.5 px-4">
                                <div class="flow-root">
                                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                            <table class="min-w-full divide-y divide-e2eaeb">
                                                <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="py-2 pl-4 pr-3 text-left text-xs font-semibold text-b0b7be sm:pl-0">
                                                        {{ __('Periodo') }}
                                                    </th>
                                                    {{--                                                    <th scope="col"--}}
                                                    {{--                                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">--}}
                                                    {{--                                                        {{ __('Fine') }}--}}
                                                    {{--                                                    </th>--}}
                                                    <th scope="col"
                                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                                        {{ __('Orari') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                                        {{ __('Mezzi') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-2 text-left text-xs font-semibold text-b0b7be">
                                                        {{ __('Capienza') }}
                                                    </th>
                                                    <th scope="col" class="relative py-2 pl-3 pr-4 sm:pr-0">
                                                        <span class="sr-only">{{ __('Azioni') }}</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                @foreach($product->availabilities as $availability)
                                                    @foreach($availability->dates()->orderBy('date_start')->orderBy('date_end')->orderBy('time_start')->orderBy('time_end')->get() as $date)
                                                        <tr>
                                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a sm:pl-0">{{ "{$date->date_start->format('d/m/Y')} - {$date->date_end->format('d/m/Y')}" }}</td>
                                                            {{--                                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $date->date_end->format('d/m/Y') }}</td>--}}
                                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ "{$date->time_start->format('H:i')} - {$date->time_end->format('H:i')}" }}</td>
                                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">{{ $date->vehicles_per_slot ?: '-' }}</td>
                                                            <td class="whitespace-nowrap px-3 py-3 text-xs text-0d171a">
                                                                <span class="px-2 py-1 bg-defbff rounded text-xs">
                                                                    {{ $date->participants_per_time }}
                                                                </span>
                                                            </td>
                                                            <td class="flex justify-end relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                                <a href="{{ route('availabilities.show', $availability->id) }}"
                                                                   class="px-1 py-1 rounded bg-defbff text-006cbc hover:cursor-pointer hover:text-white hover:bg-00abc0">
                                                                    <x-heroicon-o-eye class="w-4 h-4"/>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-0d171a">
                            {{ __('Nessun risultato trovato') }}
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
