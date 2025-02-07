<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex flex-col items-center justify-center">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />

        @if (Route::has('login'))
            <div class="absolute top-4 right-4">
                <livewire:welcome.navigation />
            </div>
        @endif

        <div>
            <div class="p-6 mx-auto max-w-7xl flex space-y-4 flex-col items-center">
                <x-application-logo class="w-24 h-24 fill-current text-primary" />
                <x-button primary xl href="{{ route('register') }}" >Get Started</x-button>
            </div>
        </div>
    </div>
    </body>

</html>
