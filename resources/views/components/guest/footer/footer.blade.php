<div class="bg-indigo-950 text-slate-200 mt-20 md:px-20 py-10 md:py-16 flex flex-col">
    <h1 class="text-3xl md:text-5xl font-semibold md:font-bold font-sans px-4">
        {{ env("APP_NAME") }}
    </h1>
    <div class="border-t border-gray-100 opacity-20 my-4 md:my-8"></div>

    <div class="flex flex-col px-4 md:px-0">
        <ul class="flex px-0">
            <li class="mr-2 md:mr-4 font-semibold text-xs md:text-base hover:underline text-slate-300">
                <a href="#">Terms of Service</a>
            </li>
            <li class="mr-2 md:mr-4 font-semibold text-xs md:text-base hover:underline text-slate-300">
                <a href="#">Privacy Policy</a>
            </li>
            <li class="mr-2 md:mr-4 font-semibold text-xs md:text-base hover:underline text-slate-300">
                <a href="#">Cookie Policy</a>
            </li>
            <li class="font-semibold text-xs md:text-base hover:underline text-slate-300">
                <a href="#">Accessibility</a>
            </li>
        </ul>
        <p class="mt-5 text-slate-300 text-xs md:text-sm font-semibold">
            &copy; {{ date("Y") }} {{ env("APP_NAME") }}. All rights reserved. 4711 Yonge St, 10th Floor, Toronto Ontario, M2N 6K8, Canada
        </p>
    </div>
</div>
