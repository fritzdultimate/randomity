<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Link Expired</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 md:p-12 max-w-md text-center relative overflow-hidden">
    <!-- Decorative Animation -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
      <div class="bg-gradient-to-r from-red-400 via-red-300 to-red-400 w-96 h-96 rounded-full blur-3xl absolute -top-24 -right-32 animate-pulse"></div>
    </div>

    <!-- Icon -->
    <div class="flex justify-center">
      <div class="bg-red-100 text-red-600 rounded-full w-20 h-20 flex items-center justify-center">
        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2m0 0l4-4m-4 4V3m0 9l4-4m-4 4h12M7 16l3 3-3-3m6 0l3 3-3-3" />
        </svg>
      </div>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-semibold text-gray-800 mt-6">Link Expired</h1>

    <!-- Description -->
    <p class="text-gray-600 mt-4">
      The link you followed has expired or is no longer valid. Please request a new link to continue.
    </p>

    <!-- Call to Action -->
    <div class="mt-6">
      <a href="{{ route('forgot-password') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11m4 4H3m12-8h7m-7 12h7m0-8h7" />
        </svg>
        Request New Link
      </a>
    </div>
  </div>
</body>
</html>
