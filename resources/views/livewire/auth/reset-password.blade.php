<div class="flex justify-center items-center h-screen w-full p-2">

    <div x-data="{ showPassword: false, password: '', password_confirmation: '', isValid: true }"
        class="shadow-md shadow-slate-200 h-full w-full px-5 bg-white rounded-lg flex flex-col justify-center items-center">

        <h1 class="capitalize text-slate-700 text-3xl font-bold font-sans py-4">Reset Password</h1>

        <form wire:submit.prevent="submit" class="w-full">

            <div x-data="{ isFocused: false }" class="relative w-full max-w-sm md:max-w-lg mx-auto mb-8">
                <!-- Label -->
                <label for="password"
                    class="absolute left-3 top-4 text-gray-500 transition-all duration-300 ease-in-out @error('password') text-red-500 @else text-gray-500 @enderror"
                    :class="{
                        '-top-3 text-sm text-blue-600 bg-white px-1': isFocused || password !== '',
                        'top-4 text-gray-500': !(isFocused || password !== '')
                    }">
                    New Password
                </label>

                <!-- Input -->
                <input id="password" :type="showPassword ? 'text' : 'password'" x-model="password"
                    wire:model.blur="password"
                    class="w-full px-3 py-4 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('password') border-red-500 @else border-slate-400 @enderror"
                    @focus="isFocused = true" @blur="isFocused = false">

                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                @if($errorMsg)
                    <p class="mt-1 text-sm text-red-500">{{ $errorMsg }}</p>
                @endif
            </div>


            <div x-data="{ isFocused: false }" class="relative w-full max-w-sm md:max-w-lg mx-auto mb-5">
                <!-- Label -->
                <label for="password_confirmation"
                    class="absolute left-3 top-4 transition-all duration-300 ease-in-out @error('password_confirmation') text-red-500 @else text-gray-500 @enderror"
                    :class="{
                        '-top-3 text-sm text-blue-600 bg-white px-1': isFocused || password_confirmation !== '',
                        'top-4 text-gray-500': !(isFocused || password_confirmation !== '')
                    }">
                    Repeat Password
                </label>

                <!-- Input -->
                <input id="password_confirmation" :type="showPassword ? 'text' : 'password'"
                    x-model="password_confirmation" wire:model.blur="password_confirmation"
                    class="w-full px-3 py-4 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 @error('password_confirmation') border-red-500 @else border-slate-400 @enderror"
                    @focus="isFocused = true" @blur="isFocused = false">

                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- CheckBox --}}
            <div class="w-full md:max-w-lg mx-auto">
                <div class="self-start md:self-center md:max-w-lg flex items-center mb-5">
                    <input @change="showPassword = !showPassword" id="show-password" type="checkbox"
                        class="h-4 w-4 md:h-5 md:w-5 text-blue-600 border-gray-300 rounded mr-1" />
                    <label for="show-password" class="text-gray-700 text-xs md:text-base font-semibold">Show
                        password</label>
                </div>
            </div>

            {{-- Button --}}
            <div class="flex w-full md:max-w-lg mx-auto">
                <input type="submit"
                    class="w-full rounded-xl text-sky-50 bg-sky-800 py-2 px-4 font-semibold text-base hover:bg-sky-900 mt-3 cursor-pointer" wire:loading.remove wire:target='submit'
                    value="Change password">

                <div class="mt-6 w-full mx-auto hidden" wire:loading wire:target='submit' wire:loading.class='flex'>
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-blue-600 border-solid border-b-2 border-b-red-500"></div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>