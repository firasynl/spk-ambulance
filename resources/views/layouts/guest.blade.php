<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Penilaian Kinerja') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div  class="w-full sm:max-w-md mt-1 px-6 py-4 overflow-hidden flex flex-col">
                <h2 class="text-center mb-8 text-3xl font-bold mb-0">Selamat Datang Kembali!</h2>
                <p class="text-center mt-0">Sistem Penilaian Kinerja</p>
                <div class="flex justify-center mt-3">
                <img src="{{ asset('/image/logo-02.png') }}" alt="Logo Ambulance Kegawatan" width="200" height="300">
                </div>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
            
        </div>
    </body>
</html>
