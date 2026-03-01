<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'AI Career Scan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-[#0B0F1A]">
    <div class="min-h-screen flex flex-col items-center pt-10 pb-10 selection:bg-indigo-500/30">
        
        <div class="w-full sm:max-w-md px-10 py-10 bg-[#161B2D] border border-slate-800 shadow-2xl sm:rounded-[2.5rem] my-auto">
            {{ $slot }}
        </div>

    </div>
</body>

</html>
