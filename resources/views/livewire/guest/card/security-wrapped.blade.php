<div class="w-full md:w-1/3 flex">
    <div class="bg-indigo-900 shadow-md rounded-3xl px-4 md:px-6 py-6 md:py-10 mb-3 md:mx-2 flex flex-col">
        <h2 class="text-base md:text-3xl font-normal">{{ $title }}</h2>
        <img src="{{ $image }}" alt="{{ $title }}" class="my-6 md:my-14 h-40 md:h-52 w-auto bg-contain">
        <div class="self-start md:text-xl md:font-sans md:font-semibold">
            {{ $content }}
        </div>

        @if ($path)
            <div class="mt-6 text-center flex justify-center md:justify-start items-center">
                <a href="{{ $path }}" class="text-slate-300 font-medium md:font-semibold text-sm md:text-base mr-2">{{ $location }}</a>
                <x-heroicon-o-arrow-long-right class="w-4 h-4" />
            </div>
        @endif
    </div>
</div>
