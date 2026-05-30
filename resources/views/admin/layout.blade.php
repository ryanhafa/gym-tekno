<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - GymTekno</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen">
        <aside class="w-64 bg-black text-white flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-800">
                <a href="{{ route('admin.members.index') }}" class="text-2xl font-extrabold tracking-tight">
                    <span class="text-red-500">Gym</span><span class="text-white">Tekno</span>
                    <span class="block text-xs text-gray-400 font-normal mt-1">Admin Panel</span>
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.members.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('admin.members.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                    <span>Data Member</span>
                </a>
                <a href="{{ route('admin.check-in.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('admin.check-in.*') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 3-3"/></svg>
                    <span>Check-In</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800 space-y-1">
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Ke Beranda</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                    <div class="text-sm text-gray-500">{{ date('d M Y') }}</div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

@stack('scripts')
</body>
</html>
