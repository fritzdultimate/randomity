<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body class="bg-repeat bg-fixed bg-white min-h-screen bg-tiny-water-droplets flex flex-col relative">
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <!-- Success Icon -->
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-16 w-16 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2l4 -4M5 12h14M12 19a7 7 0 1 0 -7 -7a7 7 0 0 0 7 7z" />
                </svg>
            </div>

            <!-- Main Message -->
            <h2 class="text-2xl font-semibold text-center text-green-800 mb-4">Registration Successful!</h2>
            <p class="text-center text-gray-600 mb-6">Your account has been created successfully. To complete the
                process, please verify your account by clicking the link we sent to your email.</p>

            <!-- Verification Instructions -->
            <div class="flex items-center justify-center space-x-2 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-6 w-6 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4v16h18V4H3zM9 8h6M9 12h6M9 16h6" />
                </svg>
                <p class="text-gray-600">Please check your inbox (and spam folder) for the verification email.</p>
            </div>

            <!-- Button to Return to Home or Login -->
            <div class="flex justify-center">
                <a href="{{ route('login') }}"
                    class="inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    Go to Login
                </a>
            </div>
        </div>
    </div>

</body>

</html>
