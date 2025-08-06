<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Load Tailwind CSS via Vite --}}
    @vite('resources/css/app.css')

</head>

<body class="text-gray-900">

    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-blue-600">👋 Welcome to Laravel!</h1>
            <p class="mt-4 text-lg text-gray-700">
                This is your first Blade + Tailwind page.
            </p>
            <a href="/home" class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Go to Home
            </a>
        </div>
    </div>

</body>

</html>