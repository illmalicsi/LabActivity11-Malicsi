<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Malicsi')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-slate-50 text-slate-900">
    <nav class="border-b border-orange-900/20 bg-orange-900 text-white shadow-sm">
        <div class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:py-4 lg:px-8">
            <a href="{{ route('posts.index') }}" class="text-lg font-bold tracking-tight">
                Barangay Bulletin – Purok Malicsi
            </a>

            <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2 text-sm sm:justify-end">
                <a href="{{ route('posts.index') }}" class="hover:text-orange-200">Posts</a>
            </div>
        </div>
    </nav>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        @yield('content')
    </main>

    <footer class="mt-auto border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-5 text-sm text-slate-500 sm:px-6 sm:py-6 lg:px-8">
            Barangay Matina Crossing Hall · Davao City
        </div>
    </footer>
</body>

</html>