<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/css/errors.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @auth
                @include('layouts.navigation')
            @endauth
            <main>
                @yield('message')
            </main>
        </div>
        @livewireScripts
    </body>
</html>
