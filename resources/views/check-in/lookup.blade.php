<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Member - GymTekno</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen">

    <div class="max-w-lg mx-auto px-4 py-10">
        <div class="text-center mb-8">
            <a href="{{ route('check-in.index') }}" class="text-3xl font-extrabold text-black hover:text-red-500 transition">
                <span class="text-red-500">Gym</span>Tekno
            </a>
            <p class="text-gray-500 mt-1">Cari data member via barcode</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('check-in.lookup') }}" class="flex space-x-2">
                <input type="text" name="barcode" value="{{ request('barcode') }}" placeholder="Masukkan barcode..."
                       class="flex-1 uppercase rounded-xl border-gray-300 px-4 py-3 focus:ring-red-500 focus:border-red-500">
                <button type="submit"
                        class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold transition">Cari</button>
            </form>
        </div>

        @if (isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-xl text-center font-medium">
                {{ $error }}
            </div>
        @endif

        @if (isset($member))
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">{{ $member->name }}</h2>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            {{ $member->status === 'active' ? 'bg-green-100 text-green-800' : ($member->status === 'suspended' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($member->status) }}
                        </span>
                    </div>
                    <div class="mt-2 text-sm text-gray-500">{{ $member->email }}</div>
                </div>
                <div class="px-6 py-4 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-400">Barcode</span>
                        <p class="font-mono font-bold text-gray-900">{{ $member->barcode }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400">Tipe</span>
                        <p class="font-medium text-gray-900 capitalize">{{ $member->membership_type }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400">Sisa Kuota</span>
                        <p class="font-bold text-lg {{ $member->quota > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $member->quota }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400">Bergabung</span>
                        <p class="font-medium text-gray-900">{{ $member->join_date->format('d M Y') }}</p>
                    </div>
                </div>

                @if ($member->expiry_date)
                    <div class="px-6 pb-4 text-sm">
                        <span class="text-gray-400">Berlaku sampai</span>
                        <p class="font-medium text-gray-900">{{ $member->expiry_date->format('d M Y') }}</p>
                    </div>
                @endif

                @if ($recentLogs->isNotEmpty())
                    <div class="border-t border-gray-100 px-6 py-4">
                        <h3 class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-3">Riwayat Check-In</h3>
                        <div class="space-y-2">
                            @foreach ($recentLogs as $log)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">{{ $log->checked_in_at->format('d M Y H:i') }}</span>
                                    <span class="text-green-600 font-medium">Masuk</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('check-in.index') }}" class="text-sm text-gray-500 hover:text-red-600 transition">← Kembali ke check-in</a>
            </div>
        @endif
    </div>

</body>
</html>
