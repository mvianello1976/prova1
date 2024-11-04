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
<body class="font-sans bg-fafcfc antialiased print:bg-white">
<x-banner/>

<div class="min-h-screen">
    <div class="print:hidden">
        @livewire('navigation-menu')
    </div>

    <!-- Page Content -->
    <main class="py-10 print:py-5">
        {{ $slot }}
    </main>
</div>

@stack('scripts')
@stack('modals')

@livewire('wire-elements-modal')
@livewireScripts
</body>
</html>
