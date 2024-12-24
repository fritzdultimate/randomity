<div class="flex flex-col p-6" id="generate-passphrase" x-data="{
    size: 12,
    passphrase: $wire.entangle('passphrase'),
    tooltipVisible: false,
    copyToClipboard: (passphraseArg = null) => {
        const component = document.getElementById('generate-passphrase');
        const data = this.Alpine.$data(component);
        const textToCopy = passphraseArg ? passphraseArg : data.passphrase.join(' ');
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    data.tooltipVisible = !passphraseArg ? true : false;
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
                    data.tooltipVisible = !passphraseArg ? true : false;
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
}">
    <!-- Skeleton Item -->
    <div class="flex flex-wrap gap-2 md:gap-4 justify-center lg:justify-start">
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
    <div class="flex flex-col w-full md:max-w-lg mx-auto mt-5 lg:mt-10" x-show="!passphrase.length">
        <input type="button" class="w-full rounded-full text-sky-50 bg-sky-700 py-2 px-4 font-semibold text-sm hover:bg-sky-900 cursor-pointer" wire:loading.remove wire:click='generate' value="Generate">

        <div class="w-full mx-auto hidden" wire:loading wire:target='generate' wire:loading.class='flex'>
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-blue-600 border-solid border-b-2 border-b-red-500"></div>
            </div>
        </div>
        @if ($errorMessage)
            <p class="text-red-500 text-base text-center py-4">{{ $errorMessage }}</p>
        @endif
    </div>

    {{-- After Render Copy and Generate Button --}}
    <div class="flex justify-center gap-2 w-full mt-10" x-show="!!passphrase.length">
        <button class="relative rounded-full bg-sky-700 text-sky-50 text-xs px-5 py-2 hover:bg-sky-800" @click="copyToClipboard()" wire:loading.class='bg-slate-500' wire:loading.attr='disabled'>
            <span class="font-semibold">Copy</span>
            {{-- Tooltip --}}
            <div x-show="tooltipVisible" x-transition class="absolute top-[-30px] left-0 bg-gray-700 text-slate-200 text-xs px-2 py-1 rounded shadow-lg opacity-95">
                Copied!

                <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-t-[6px] border-t-gray-700 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent"></div>
            </div>
            {{--! Tooltip --}}
        </button>

        <button class="rounded-full bg-sky-700 text-sky-50 text-xs px-5 py-2 font-semibold hover:bg-sky-800 flex" wire:target='generate' wire:loading.attr='disabled' wire:loading.class='bg-slate-500 hover:bg-slate-500' @click="copyToClipboard()">
            <span wire:loading.remove wire:click='generate'>
                Copy & Generate
            </span>

            <div wire:loading wire:target='generate' wire:loading.class='flex' class="animate-spin rounded-full h-4 w-4 border-t-2 border-white border-solid hidden"></div>
        </button>

        <button class="rounded-full bg-sky-700 text-sky-50 text-xs px-5 py-2 font-semibold hover:bg-sky-800 flex" wire:target='generate' wire:loading.attr='disabled' wire:loading.class='bg-slate-500 hover:bg-slate-500'>
            <span wire:loading.remove wire:click='generate'>Regenerate</span>
            <div wire:loading wire:target='generate' wire:loading.class='flex' class="animate-spin rounded-full h-4 w-4 border-t-2 border-white border-solid hidden"></div>
        </button>

    </div>

</div>