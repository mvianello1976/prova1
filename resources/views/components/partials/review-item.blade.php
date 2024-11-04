<div {{ $attributes->merge(['class' => 'relative py-6 sm:grid sm:grid-cols-3 sm:gap-4']) }}>
    @isset($trigger)
        <div
            class="grid place-items-center absolute inset-y-0 w-6 h-6 top-5 translate-y-1 right-0 text-0d171a bg-e2eaeb rounded hover:cursor-pointer hover:bg-e2eaeb/70">
            {{ $trigger }}
        </div>
    @endisset
    @isset($title)
        <dt class="text-sm font-medium leading-6 text-gray-900">
            {{ $title }}
        </dt>
    @endisset
    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
        {{ $slot }}
    </dd>
</div>
