<div class="w-full h-full bg-white" id="dashboard" x-data="{}">
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

    <div class="w-full h-full">
      {{-- <div class="mb-16 lg:mb-0"></div> --}}
      <div class="w-full h-full">
        <div class="w-full h-full">
            <div class="pl-4 py-2 lg:p-4 w-full shadow-md flex">
                <div x-data="{ }" class="relative w-16 md:w-24">
                    <!-- Label -->
                    <label for="sizeInput"
                        class="absolute text-gray-600 text-xs left-3 bg-white px-1 -top-2 transition-all duration-300 ease-in-out">
                        Size
                    </label>
    
                    <!-- Input -->
                    <input id="sizeInput" type="text" wire:model='size' wire:input='triggerSizeUpdate'
                        class="w-full px-3 py-2 border border-slate-400 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
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