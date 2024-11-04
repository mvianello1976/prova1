<div class="bg-fafcfc px-6 py-8">
    <h3 class="text-lg font-semibold text-0d171a">{{ __('Dove vuoi andare?') }}</h3>
    <div class="mt-7 space-y-2">
        <x-tripsy-select wire:key="destination" wire:model="selectedDestination">
            <x-slot:title>
                {{ $selectedDestination['value'] ?? __('Destinazione') }}
            </x-slot:title>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                </svg>
            </x-slot:icon>
            <x-slot:content>
                <li wire:click="geolocation" class="group flex items-center justify-between font-semibold text-00abc0">
                    <span class="group-hover:text-00abc0">{{ __('Vicino a me') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:text-00abc0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </li>
                @foreach($destinations as $k => $item)
                    <li wire:key="destination-{{$k}}" wire:click="setDestination('{{$item['id']}}', '{{$item['value']}}')"
                        class="{{ isset($selectedDestination['id']) && $selectedDestination['id'] == $item['id'] ? 'text-ffa14a' : '' }}"
                    >
                        {{ $item['value'] }}
                    </li>
                @endforeach
            </x-slot:content>
        </x-tripsy-select>
        <x-datepicker wire:model.live="date" inline>
            <x-slot:title>
                {{ __('Quando') }}
            </x-slot:title>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                </svg>
            </x-slot:icon>
        </x-datepicker>
        <x-tripsy-select wire:key="category" wire:model="selectedCategory">
            <x-slot:title>
                {{ $selectedCategory['value'] ?? __('Tipologia servizio') }}
            </x-slot:title>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                </svg>
            </x-slot:icon>
            <x-slot:content>
                @foreach($categories as $k => $item)
                    <li wire:key="category-{{$k}}" wire:click="setCategory('{{$item['id']}}', '{{$item['value']}}')"
                        class="{{ isset($selectedCategory['id']) && $selectedCategory['id'] == $item['id'] ? 'text-ffa14a' : '' }}"
                    >
                        {{ $item['value'] }}
                    </li>
                @endforeach
            </x-slot:content>
        </x-tripsy-select>
        <x-tripsy-select wire:key="participant" wire:model="participant">
            <x-slot:title>
                {{ $participant ? trans_choice('{1} :count persona|[2,*] :count persone', $participant) : __('Persone') }}
            </x-slot:title>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                </svg>
            </x-slot:icon>
            <x-slot:content>
                @foreach($participants as $k => $participant)
                    <li wire:key="participant-{{$k}}" wire:click="$set('participant', '{{ $participant }}')"
                        class="{{ $participant == $item['id'] ? 'text-ffa14a' : '' }}"
                    >
                        {{ $participant }}
                    </li>
                @endforeach
            </x-slot:content>
        </x-tripsy-select>
    </div>
    <x-tripsy-button wire:click="search" :disabled="!$selectedDestination || !$date" class="mt-8 w-full bg-ffbb7c text-white">{{ __('Cerca') }}</x-tripsy-button>
</div>
