<div class="" x-data="{
    passphraseHistory: $wire.entangle('passphraseHistory'),
    copyToClipboard: (passphraseArg = null) => {
            const textToCopy = passphraseArg;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(textToCopy)
                    .then(() => {
                        //
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
                    } catch (err) {
                        console.error('Failed to copy using execCommand:', err);
                    } finally {
                        document.body.removeChild(textarea);
                    }
            }
    }
}">
    <div class="flex px-4 justify-between w-full">
        <div class="text-slate-900 text-base font-semibold">
            <span>History</span>
        </div>

        <a href="/" class="text-sky-900 text-sm font-medium">See all</a>
    </div>
    <div class="border-b border-b-slate-300 w-full pb-2"></div>

    <template x-for="(histories, key) of passphraseHistory" :key="key">
        <div class="p-4">
            <div class="mb-2 px-3">
                <span class="text-slate-700 text-base font-semibold capitalize" x-text="key"></span>
                <span x-text="'(' + histories.length + ' record' + (histories.length > 1 ? 's)' : ')')" class="text-[10px] text-slate-500 font-medium"></span>
            </div>

            <ul>
                <template x-for="(phrase, index) of histories" :key="index">
                    <li class="flex items-center px-6 py-2 w-full rounded-full bg-slate-200 text-slate-700 border border-slate-300 border-opacity-50 text-xs font-medium hover:bg-slate-300 cursor-pointer mb-3" x-data="{tooltip: false}">
                        <span x-text="phrase.passphrase.length > 7 ? phrase.passphrase.slice(0, 7).join(' ') + '...' : phrase.passphrase.join(' ')"></span>

                        <div class="ml-auto flex items-center">
                            <div class="relative p-2 mr-1 rounded-full" @click="() => {
                                tooltip = true;
                                copyToClipboard(phrase.passphrase.join(' '))
                                setTimeout(() => {
                                    tooltip = false;
                                }, 2000);
                            }">
                                <x-solar-copy-bold-duotone class="h-4 w-4 text-blue-600 cursor-pointer hover:animate-pulse focus:animate-pulse transition-all duration-200" />

                                {{-- Tooltip --}}
                                <div x-show="tooltip" x-transition class="absolute top-[-30px] left-0 bg-gray-700 text-slate-200 text-xs px-2 py-1 rounded shadow-lg opacity-95">
                                    Copied!

                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-t-[6px] border-t-gray-700 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent"></div>
                                </div>
                                {{--! Tooltip --}}
                            </div>

                            <div class="" x-data="{deleting: false}">
                                <template x-if="deleting">
                                    <div class="animate-spin rounded-full h-3 w-3 border-solid border-b-2 border-b-red-600"></div>
                                </template>
                                <template x-if="!deleting">
                                    <x-elemplus-delete class="h-4 w-4 text-red-500 cursor-pointer hover:animate-pulse focus:animate-pulse transition-all duration-200" @click="() => {
                                        $wire.deletePhrase(phrase.id);
                                        deleting = true;
                                        setTimeout(() => {
                                            histories.splice(index, 1);
                                            deleting = false;
                                        }, 3000);
                                    }" />
                                </template>
                            </div>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </template>
</div>