<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Recovery Email Sent</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 lg:p-12 max-w-md text-center relative overflow-hidden">
    <!-- Animated Icon -->
    <div class="flex justify-center">
      <div class="bg-green-100 text-green-600 rounded-full w-20 h-20 flex items-center justify-center animate-bounce">
        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-semibold text-gray-800 mt-6">Email Sent Successfully!</h1>

    <!-- Description -->
    <p class="text-gray-600 mt-4">
      We’ve sent you an email with instructions to reset your password.
      Please check your inbox or spam folder to proceed.
    </p>

    <!-- Button -->
    <div class="mt-6">
      <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Login
      </a>
    </div>

    <!-- Decorative Animation -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
      <div class="bg-gradient-to-r from-blue-400 via-blue-200 to-blue-400 w-96 h-96 rounded-full blur-3xl absolute -top-24 -right-32 animate-pulse"></div>
    </div>
  </div>
</body>
</html>
