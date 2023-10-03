<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Affinity') }}</title>

    <link rel="icon" href="{{asset('images/logo.png')}}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Livvic:wght@400;500;600;700&display=swap">

    <!-- vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles

    <!-- Google tag (gtag.js) -->
    @if(env('APP_ENV') !== 'local')
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-SVRF297EFW"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-SVRF297EFW');
        </script>
    @endif
</head>
<body class="antialiased livvic-font">

<div class="min-h-screen">

    {{-- Header --}}
    @include('includes.navigation')

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    {{-- Page Content --}}

    {{-- Footer --}}
    @include('includes.footer')

</div>

{{-- Livewire scripts --}}
@livewireScripts

</body>
</html>
