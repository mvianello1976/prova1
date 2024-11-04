<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css"/>
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div class="print:hidden">
    @livewire('common.header')
</div>
<main class="{{ request()->route()->getName() === 'guest.index' ? '' : '' }}">
    {{ $slot }}
</main>

{{-- Live chat button --}}
<div class="fixed z-10 flex items-center justify-around w-14 h-14 bottom-24 right-4 text-white bg-006cbc rounded-full hover:cursor-pointer lg:bottom-10 lg:right-10 print:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 -scale-x-100">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/>
    </svg>
</div>
<div class="print:hidden">
<x-bottom-navigation-bar/>
</div>

<div class="print:hidden">
    @livewire('common.footer')
</div>

@livewire('wire-elements-modal')
@livewireScripts
</body>
</html>
