<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @php($guestSettings = \App\Models\SiteSetting::current())
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/" class="flex items-center gap-2 font-extrabold text-2xl text-indigo-600">
                    @if($guestSettings->logo_url)
                        <img src="{{ $guestSettings->logo_url }}" alt="{{ $guestSettings->site_name }}" class="h-12 w-auto">
                    @else
                        <span class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-600 text-white text-2xl">
                            {{ mb_substr($guestSettings->site_name ?? 'B', 0, 1) }}
                        </span>
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
