<div class="w-full h-full bg-white" id="dashboard" x-data="
    {
        sidebarOpen: false, 
        size: 12,
    }
">
    @push('style')
    <style>
        @keyframes shimmer {
          0% {
            background-position: -200px 0;
          }
          100% {
            background-position: 200px 0;
          }
        }
      
        .skeleton-box {
          position: relative;
          overflow: hidden;
        }
      
        .skeleton-box::after {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: linear-gradient(
            90deg,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.2) 50%,
            rgba(255, 255, 255, 0) 100%
          );
          animation: shimmer 1.5s infinite;
          background-size: 200px 100%;
        }
      </style>      
    @endpush
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

    <div class="w-full h-full">
      <div class="mb-16"></div>
      <div class="lg:ml-64g w-full h-full">
        <div class="w-full h-full">
            <div class="p-2 w-full shadow-md flex ml-auto justify-end">
                <div x-data="{ isFocused: false }" class="relative w-16 md:w-24">
                    <!-- Label -->
                    <label for="sizeInput"
                        class="absolute text-gray-600 text-xs left-3 bg-white px-1 -top-2 transition-all duration-300 ease-in-out"
                        :class="{
                            'text-blue-600': isFocused || size !== '',
                            'text-gray-600': !(isFocused || size !== '')
                        }">
                        Size
                    </label>
    
                    <!-- Input -->
                    <input id="sizeInput" type="text" wire:model.live="size" wire:input='triggerSizeUpdate'
                        class="w-full px-3 py-2 border border-slate-400 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                        @focus="isFocused = true" @blur="isFocused = false">
                </div>
            </div>

            <div class="flex flex-col w-full">
                <livewire:dashboard.generate-passphrase :size="$size" />

                <livewire:dashboard.history :count="30" />
            </div>
        </div>
        
      </div>
    </div>
</div>