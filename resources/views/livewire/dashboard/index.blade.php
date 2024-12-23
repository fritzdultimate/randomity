<div class="w-full h-full bg-white" id="dashboard" x-data="
    {
        sidebarOpen: false, 
        size: 12, 
        passphrase: $wire.entangle('passphrase'),
        tooltipVisible: false,
        copyToClipboard: () => {
            const component = document.getElementById('dashboard');
            const data = this.Alpine.$data(component);
            const textToCopy = data.passphrase.join(' ');
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(textToCopy)
                    .then(() => {
                        data.tooltipVisible = true;
                        setTimeout(() => {
                            data.tooltipVisible = false;
                        }, 2000);
                    })
                    .catch(err => {
                        console.error('Failed to copy:', err);
                    });
            } else {
                    // Fallback for older browsers
                    const textarea = document.createElement('textarea');
                    textarea.value = textToCopy;
                    document.body.appendChild(textarea);
                    textarea.select();

                    try {
                        document.execCommand('copy');
                        data.tooltipVisible = true;
                        setTimeout(() => {
                            data.tooltipVisible = false;
                        }, 2000);
                    } catch (err) {
                        console.error('Failed to copy using execCommand:', err);
                    } finally {
                        document.body.removeChild(textarea);
                    }
                }
        }
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
                    <input id="sizeInput" type="text" wire:model.blur="size"
                        class="w-full px-3 py-2 border border-slate-400 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                        @focus="isFocused = true" @blur="isFocused = false">
                </div>
            </div>

            <div class="flex flex-col w-full">

                <div class="flex flex-col p-6 lg:justify-center">
                    <!-- Skeleton Item -->
                    <div class="flex flex-wrap gap-2 md:gap-4 lg:ml-52 justify-center">
                        <template x-if="!passphrase.length">
                            <template x-for="n of size" :key="n">
                                <div class="skeleton-box w-24 h-6 rounded bg-slate-300"></div>
                            </template>
                        </template>
                        <template x-if="passphrase.length">
                            <template x-for="phrase of passphrase" :key="phrase">
                                <div class="skeleton-box px-6 rounded bg-white border border-slate-300 hover:bg-slate-200 text-sm font-normal text-slate-800 cursor-pointer" x-text="phrase"></div>
                            </template>
                        </template>
                    </div>

                    {{-- Initial Generate Button --}}
                    <div class="flex w-full md:max-w-lg mx-auto mt-5 lg:mt-10" x-show="!passphrase.length">
                        <input type="button" class="w-full rounded-full text-sky-50 bg-sky-700 py-2 px-4 font-semibold text-sm hover:bg-sky-900 cursor-pointer" wire:loading.remove wire:target='generate' wire:click='generate' value="Generate">

                        <div class="w-full mx-auto hidden" wire:loading wire:target='generate' wire:loading.class='flex'>
                            <div class="flex justify-center">
                                <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-blue-600 border-solid border-b-2 border-b-red-500"></div>
                            </div>
                        </div>
                    </div>

                    {{-- After Render Copy and Generate Button --}}
                    <div class="flex justify-center gap-2 w-full mt-10" x-show="!!passphrase.length">
                        <button class="relative rounded-full bg-sky-700 text-sky-50 text-xs px-5 py-2 hover:bg-sky-800" @click="copyToClipboard()">
                            <span class="font-semibold">Copy</span>
                            {{-- Tooltip --}}
                            <div x-show="tooltipVisible" x-transition class="absolute top-[-30px] left-0 bg-gray-700 text-slate-200 text-xs px-2 py-1 rounded shadow-lg opacity-95">
                                Copied!

                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-t-[6px] border-t-gray-700 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent"></div>
                            </div>
                            {{--! Tooltip --}}
                        </button>

                        <button class="rounded-full bg-sky-700 text-sky-50 text-xs px-5 py-2 font-semibold hover:bg-sky-800 flex" wire:target='generate' wire:loading.attr='disabled' wire:loading.class='bg-slate-500 hover:bg-slate-500' @click="copyToClipboard()">
                            <span wire:loading.remove wire:target='generate' wire:click='generate'>
                                Copy & Generate
                            </span>

                            <div wire:loading wire:target='generate' wire:loading.class='flex' class="animate-spin rounded-full h-4 w-4 border-t-2 border-white border-solid hidden"></div>
                        </button>

                        <button class="rounded-full bg-sky-700 text-sky-50 text-xs px-5 py-2 font-semibold hover:bg-sky-800 flex" wire:target='generate' wire:loading.attr='disabled' wire:loading.class='bg-slate-500 hover:bg-slate-500'>
                            <span wire:loading.remove wire:target='generate' wire:click='generate'>Regenerate</span>
                            <div wire:loading wire:target='generate' wire:loading.class='flex' class="animate-spin rounded-full h-4 w-4 border-t-2 border-white border-solid hidden"></div>
                        </button>

                    </div>

                </div>

                <div class="">
                    <div class="flex px-4 justify-between w-full">
                        <div class="text-slate-900 text-base font-semibold">
                            <span>History</span>
                        </div>

                        <a href="/" class="text-sky-900 text-sm font-medium">See all</a>
                    </div>
                    <div class="border-b border-b-slate-300 w-full pb-2"></div>

                    <ul class="p-4">
                        <li class="flex items-center px-6 py-2 w-full rounded-full bg-slate-200 text-slate-700 border border-slate-300 border-opacity-50 text-xs font-medium">
                            <span>hello daniel klotthin facecap kitchen...</span>

                            <div class="ml-auto p-2 rounded-full relative" @click="copyToClipboard()">
                                <x-solar-copy-bold-duotone class="h-4 w-4 text-blue-600 cursor-pointer hover:animate-pulse focus:animate-pulse transition-all duration-200" />

                                {{-- Tooltip --}}
                                <div x-show="tooltipVisible" x-transition class="absolute top-[-30px] left-0 bg-gray-700 text-slate-200 text-xs px-2 py-1 rounded shadow-lg opacity-95">
                                    Copied!

                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-t-[6px] border-t-gray-700 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent"></div>
                                </div>
                                {{--! Tooltip --}}
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        
      </div>
    </div>
</div>