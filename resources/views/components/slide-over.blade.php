@props([
'size' => 'sm',
'sizeClasses' => [
'xs' => 'sm:max-w-xs',
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
'3xl' => 'sm:max-w-3xl'
],
'from' => 'right',
])

<div x-data="{ open: false }" @close-slide-over="open = false">
	<div class="flex items-center">
		<!-- Mobile menu button -->
		<div @click="open = true" class="w-full cursor-pointer" aria-expanded="false">
			{{$trigger}}
		</div>
	</div>
	<!-- Mobile menu, show/hide this `div` based on menu open/closed state -->
	<div x-show="open" class="fixed inset-0 z-40">
		<div
			x-cloak
			x-show="open"
			@click="open = false; Livewire.emit('closed')"
			x-transition:enter="transition-opacity ease-linear duration-300"
			x-transition:enter-start="opacity-0"
			x-transition:enter-end="opacity-100"
			x-transition:leave="transition-opacity ease-linear duration-300"
			x-transition:leave-start="opacity-100"
			x-transition:leave-end="opacity-0"
			class="hidden sm:block sm:fixed sm:inset-0"
			aria-hidden="true">
			<div class="absolute inset-0 bg-gray-600 opacity-75"></div>
		</div>
		<div
			x-cloak
			x-show="open"
			x-transition:enter="transition ease-out duration-150 sm:ease-in-out sm:duration-300"
			x-transition:enter-start="transform opacity-0 scale-110 {{ $from === 'left' ? 'sm:-translate-x-full' : 'sm:translate-x-full' }} sm:scale-100 sm:opacity-100"
			x-transition:enter-end="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100"
			x-transition:leave="transition ease-in duration-150 sm:ease-in-out sm:duration-300"
			x-transition:leave-start="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100"
			x-transition:leave-end="transform opacity-0 scale-110 {{ $from === 'left' ? 'sm:-translate-x-full' : 'sm:translate-x-full' }} sm:scale-100 sm:opacity-100"
			class="fixed z-40 inset-0 h-full w-full bg-white px-2 sm:px-0 sm:inset-y-0 {{ $from === 'left' ? 'sm:right-auto' : 'sm:left-auto' }} sm:right-0 {{ $sizeClasses[$size] }} sm:w-full sm:shadow-lg"
			aria-label="Global">
			<div class="flex items-center h-16 px-4 sm:px-6">
				<div class="w-full flex justify-between items-center {{ $from === 'left' ? '' : 'flex-row-reverse' }}">
					<button @click="open = false; Livewire.emit('closed')" type="button" class="inline-flex items-center justify-center p-2 -ml-2 text-gray-400 rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-600" aria-expanded="false">
						<span class="sr-only">Open sidebar menu</span>
						<svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
					@isset($headerActions)
						{{ $headerActions }}
					@endisset
				</div>
			</div>
			<div class="max-w-8xl mx-auto py-3 px-2 sm:px-4 h-full overflow-y-scroll @isset($footer) pb-36 @else pb-20 @endisset">
				{{ $slot }}
			</div>
			@isset($footer)
				<div class="absolute bottom-0 w-full px-4 py-3 bg-white border-t sm:px-6">
					{{ $footer }}
				</div>
			@endisset
		</div>
	</div>
</div>