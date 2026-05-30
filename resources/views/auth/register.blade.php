<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - GymTekno</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-6">
        <a href="/" class="block text-center mb-8">
            <span class="text-3xl font-extrabold tracking-tight text-red-500">Gym<span class="text-black">Tekno</span></span>
        </a>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-2">Daftar Member Baru</h2>
            <p class="text-gray-500 text-center mb-8 text-sm">Isi data untuk mendapatkan kartu member</p>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full rounded-lg border-gray-300 border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                           placeholder="Nama lengkap" required autofocus>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full rounded-lg border-gray-300 border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                           placeholder="email@contoh.com" required>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="w-full rounded-lg border-gray-300 border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                           placeholder="08xxxxxxxxxx">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password"
                           class="w-full rounded-lg border-gray-300 border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                           placeholder="Minimal 6 karakter" required>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full rounded-lg border-gray-300 border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                           placeholder="Ulangi password" required>
                </div>

                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-red-500 hover:text-red-700 font-medium">Masuk</a>
            </p>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            <a href="/" class="text-red-500 hover:text-red-700 font-medium">&larr; Kembali ke Beranda</a>
        </p>
    </div>

</body>
</html>
