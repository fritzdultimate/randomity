<div>
    <style>
        body {
            /* font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, rgba(133, 221, 233, 0.288), #70c4dd17);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            width: 100% */
        }
    </style>
    <div class="mt-20 px-6 w-full md:px-24 relative">
        <div
            class="text-6xl md:text-9xl md:font-normal md:w-4/5 md:font-mono font-medium leading-tight text-sky-900 font-sans md:mb-6">
            Every sign-in, <span class="text-sky-700">secure</span>
        </div>

        <div class="text-xl md:text-4xl text-sky-900 font-sans mb-16">
            <div class="ml-auto md:px-6 md:w-2/5">
                <p class="pt-12 pb-6">{{ env('APP_NAME') }} is so much more than a password manager.</p>

                <div class="flex flex-col md:flex-row w-full font-medium md:justify-between md:items-center">
                    <a href="#"
                        class="bg-sky-700 hover:bg-sky-800 text-white text-center rounded-full py-2 text-sm w-full md:w-[47%]">View
                        plans</a>
                    <a href="#"
                        class="border border-sky-900 text-sky-900 text-center rounded-full py-2 w-full text-sm mt-3 md:mt-0 md:w-[47%]">Talk
                        to sales</a>
                </div>
            </div>

        </div>

        <div class="py-10 px-8 bg-indigo-950 rounded-3xl absolute left-0 w-full text-slate-200">
            <h2 class="text-3xl font-normal font-sans mb-8 md:py-20 md:px-16 md:text-6xl md:w-2/3">Security and
                productivity wrapped into one</h2>

            <div class="flex flex-col md:flex-row w-full">
                @livewire('guest.card.security-wrapped', ['title' => 'Secure every sign-in', 'content' => 'Store all sign-ins in secure vaults, with the ability to securely share passwords, secrets, and more.', 'image' => '/images/g/secure-signin.png', 'path' => '/#', 'location' => 'See security features'])

                @livewire('guest.card.security-wrapped', ['title' => 'To every application', 'content' => 'Manage access to every application and web account for every member of your account.', 'image' => '/images/g/apps.png', 'path' => '/#', 'location' => 'Compare plans'])

                @livewire('guest.card.security-wrapped', ['title' => 'From any device', 'content' => 'Sign in to everything from any device, and manage permissions to ensure only healthy devices are allowed access.', 'image' => '/images/g/devices.png', 'path' => '/#', 'location' => 'Explore our security model'])
            </div>

        </div>
    </div>
</div>
