<div x-data="scan" class="max-w-6xl mx-auto">
    <video
        id="scanner"
        class="w-full -scale-x-100"
    ></video>
    <div class="mt-7 text-center flex flex-col items-center">
        @if($code)
            <x-tripsy-button color="orange" wire:click="confirm('{{ $code }}')" class="will-change-auto">
                {{ __('Conferma') }}
            </x-tripsy-button>
        @else
            <span class="inline-flex text-sm items-center justify-center px-8 py-2.5">
                {{ __('Punta la fotocamera verso il codice del biglietto :appname', ['appname' => env('APP_NAME')]) }}
            </span>
        @endif
        <div class="my-5 w-full max-w-lg relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-fafcfc px-2 text-sm text-gray-500">{{ __('Oppure') }}</span>
            </div>
        </div>
        <x-tripsy-button
            wire:click="$dispatch('openModal', {component: 'partner.pages.booking.modals.insert-code-manually'})"
            color="orange"
        >
            {{ __('Inserisci manualmente') }}
        </x-tripsy-button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('scan', () => ({
            scanner: new window.QrScanner(
                document.getElementById('scanner'),
                result => {
                    Livewire.dispatch('scanned', {data: result})
                },
                {
                    onDecodeError: error => {
                        Livewire.dispatch('scanned', {data: null})
                    },
                    maxScansPerSecond: 2,
                    returnDetailedScanResult: true
                },
            ),
            init() {
                window.QrScanner.hasCamera().then(res => {
                    this.scanner.start()
                    this.scanner.setCamera('environment')
                }).catch(error => {
                    console.log(error)
                })
            },
        }));
    });
</script>
