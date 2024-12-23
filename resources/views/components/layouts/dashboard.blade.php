<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @stack('style')

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="bg-gray-100 h-screen flex">
        {{ $slot }}

        @stack('scripts')
    </body>
</html>
