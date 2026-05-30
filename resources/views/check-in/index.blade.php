<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check-In Member - GymTekno</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-black">
                <span class="text-red-500">Gym</span>Tekno
            </h1>
            <p class="text-gray-500 mt-1">Scan barcode member untuk check-in</p>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-xl text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-xl text-center font-medium">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('check-in.scan') }}" method="POST" class="space-y-5" id="scanForm">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 text-center">Barcode Member</label>
                    <input type="text" name="barcode" id="barcodeInput" placeholder="Scan atau ketik barcode..."
                           class="w-full text-center text-lg tracking-widest uppercase rounded-xl border-gray-300 px-4 py-4 focus:ring-red-500 focus:border-red-500"
                           autofocus autocomplete="off">
                </div>
                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-xl text-lg font-bold transition shadow-md">
                    Check-In
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                <a href="{{ route('check-in.lookup') }}" class="text-sm text-gray-500 hover:text-red-600 transition">Cari data member →</a>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('admin.members.index') }}" class="text-xs text-gray-400 hover:text-gray-600 transition">Admin Panel</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('scanForm').addEventListener('submit', function() {
            document.getElementById('barcodeInput').value =
                document.getElementById('barcodeInput').value.toUpperCase();
        });
    </script>

</body>
</html>
