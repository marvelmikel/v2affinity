<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Affinity') }}</title>

    <link rel="icon" href="{{asset('images/logo.png')}}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Livvic:wght@400;500;600;700&display=swap">

    <!-- vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles

</head>
<body class="antialiased livvic-font">

<div class="min-h-screen">

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    {{-- Page Content --}}

</div>

{{-- Livewire scripts --}}
@livewireScripts

</body>
</html>
