<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @stack('style')

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="bg-gray-100 h-full flex">
        <div class="w-full h-full bg-white" x-data="{ sidebarOpen: false }">
            {{-- Sidebar for smaller screen --}}
            <div class="md:hidden" x-show="sidebarOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
                <livewire:partials.sidebar />
            </div>
            {{--! Sidebar for smaller screen --}}
            {{-- Sidebar for large screen --}}
            <div class="hidden md:block">
                <livewire:partials.sidebar />
            </div>
            {{--! Sidebar for large screen --}}

            {{-- Sidebar Overlay --}}
            <div class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90 md:hidden" id="sidebarBackdrop"
                x-show="sidebarOpen" 
                @click="sidebarOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-50"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-50"
                x-transition:leave-end="opacity-0"
            ></div>
            {{--! Sidebar Overlay --}}
            <livewire:partials.navbar />
            <div class="pt-16 lg:pt-14 lg:pl-64 w-full h-full">
                {{ $slot }}
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
