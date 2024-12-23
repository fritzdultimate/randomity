<!-- Elegant Header with Smooth Mobile Transition -->
<header x-data="{ open: false }" class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('landing') }}"
            class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-transform transform hover:scale-105">
            RANDOMITY
        </a>

        <!-- Desktop Buttons -->
        <div class="hidden md:flex space-x-6 items-center">
            <a href="/sign/in" class="text-gray-700 hover:text-blue-600 transition-colors duration-300">Login</a>
            <a href="/sign/up"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all duration-300 shadow-md">
                Register
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'block': !open }" class="block" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{ 'block': open, 'hidden': !open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu with Smooth Transition -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-10"
        class="md:hidden bg-white shadow-md">
        <div class="flex flex-col items-center space-y-4 py-4 px-10">
            <a href="/sign/in"
                class="text-sky-700 bg-sky-100 hover:text-sky-900 transition-colors duration-300 w-full py-2 text-center text-base font-semibold rounded-md hover:bg-sky-200">Login</a>
            <a href="/sign/up"
                class="bg-sky-600 text-sky-50 px-4 py-2 rounded-md hover:bg-sky-700 transition-all duration-300 shadow-md w-full text-center text-base font-semibold">
                Register
            </a>
        </div>
    </div>
</header>
