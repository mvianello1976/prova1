<div>
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="grid grid-cols-3 border rounded-md bg-e2eaeb p-0.5">
            <div wire:click="$set('currentTab', 'profile')" class="flex items-center justify-center space-x-2 rounded text-center text-sm py-3 hover:cursor-pointer {{ $currentTab === 'profile' ? 'bg-white text-03b8ce font-semibold' : 'bg-transparent text-0d171a hover:text-00abc0' }}">
                <x-heroicon-o-user class="w-5 h-5"/>
                <span>
                    {{ __('Profilo') }}
                </span>
            </div>
            <div wire:click="$set('currentTab', 'payments')" class="flex items-center justify-center space-x-2 rounded text-center text-sm py-3 hover:cursor-pointer {{ $currentTab === 'payments' ? 'bg-white text-03b8ce font-semibold' : 'bg-transparent text-0d171a hover:text-00abc0' }}">
                <x-heroicon-o-credit-card class="w-5 h-5"/>
                <span>
                    {{ __('Dati pagamento') }}
                </span>
            </div>
            <div wire:click="$set('currentTab', 'settings')" class="flex items-center justify-center space-x-2 rounded text-center text-sm py-3 hover:cursor-pointer {{ $currentTab === 'settings' ? 'bg-white text-03b8ce font-semibold' : 'bg-transparent text-0d171a hover:text-00abc0' }}">
                <x-heroicon-o-cog-8-tooth class="w-5 h-5"/>
                <span>
                    {{ __('Impostazioni') }}
                </span>
            </div>
        </div>
        <div class="border rounded bg-white p-8">
            @switch($currentTab)
                @case('profile')
                    <livewire:partner.pages.profile.tabs.profile/>
                    @break
                @case('payments')
                    <livewire:partner.pages.profile.tabs.payments/>
                    @break
                @case('settings')
                    <livewire:partner.pages.profile.tabs.settings/>
                    @break
            @endswitch
        </div>
    </div>
</div>
