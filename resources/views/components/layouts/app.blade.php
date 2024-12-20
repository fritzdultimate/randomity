<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="bg-repeat bg-fixed bg-white h-screen bg-tiny-water-droplets">
        @include('components.guest.header.header')
        {{ $slot }}
    </body>
</html>
