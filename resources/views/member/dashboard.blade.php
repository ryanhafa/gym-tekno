<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Member - GymTekno</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <nav class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-2xl font-extrabold tracking-tight">
                    <span class="text-red-500">Gym</span><span class="text-white">Tekno</span>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-400">{{ $member->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-800 px-8 py-6">
                <h1 class="text-2xl font-bold text-white">Dashboard Member</h1>
            </div>

            @if (session('success'))
                <div class="m-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-8 grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm text-gray-500 uppercase tracking-wider font-medium mb-4">Informasi Member</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Nama</span>
                            <p class="font-semibold">{{ $member->name }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email</span>
                            <p class="font-semibold">{{ $member->email }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Nomor HP</span>
                            <p class="font-semibold">{{ $member->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Barcode</span>
                            <p class="font-mono font-semibold text-sm">{{ $member->barcode }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500 uppercase tracking-wider font-medium mb-4">Status Keanggotaan</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Tipe Member</span>
                            <p class="font-semibold capitalize">{{ $member->membership_type }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Status</span>
                            <p>
                                @php
                                    $statusColors = ['active' => 'bg-green-100 text-green-800', 'inactive' => 'bg-gray-100 text-gray-800', 'suspended' => 'bg-red-100 text-red-800'];
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$member->status] ?? 'bg-gray-100' }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Sisa Kuota</span>
                            <p class="text-3xl font-extrabold {{ $member->quota > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $member->quota }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Tanggal Bergabung</span>
                            <p class="font-semibold">{{ $member->join_date->format('d M Y') }}</p>
                        </div>
                        @if ($member->expiry_date)
                        <div>
                            <span class="text-sm text-gray-500">Berlaku Sampai</span>
                            <p class="font-semibold">{{ $member->expiry_date->format('d M Y') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-8">
            <div class="px-8 py-6 border-b border-gray-200">
                <h2 class="text-lg font-bold">Kartu Member</h2>
            </div>
            <div class="p-8 flex flex-col items-center">
                <div class="bg-black rounded-2xl p-8 w-full max-w-sm text-white">
                    <div class="text-center mb-6">
                        <div class="text-xl font-extrabold tracking-tight">
                            <span class="text-red-500">Gym</span>Tekno
                        </div>
                        <div class="text-xs text-gray-400 mt-1">MEMBER CARD</div>
                    </div>

                    <div class="text-center mb-6">
                        <div class="text-lg font-bold">{{ $member->name }}</div>
                        <div class="text-xs text-gray-400 capitalize">{{ $member->membership_type }}</div>
                    </div>

                    <div class="flex justify-center mb-4">
                        <svg id="barcode" class="bg-white p-2 rounded"></svg>
                    </div>

                    <div class="text-center">
                        <div class="text-xs text-gray-400">Barcode</div>
                        <div class="font-mono text-sm tracking-widest">{{ $member->barcode }}</div>
                    </div>

                    <div class="mt-4 flex justify-between text-xs text-gray-400">
                        <span>Bergabung: {{ $member->join_date->format('d/m/Y') }}</span>
                        <span>Sisa: {{ $member->quota }}</span>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-4">Tunjukkan kartu ini saat check-in di gym</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mt-8">
            <div class="px-8 py-6 border-b border-gray-200">
                <h2 class="text-lg font-bold">Riwayat Check-In</h2>
            </div>
            <div class="p-8">
                @if ($recentLogs->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 border-b border-gray-200">
                                    <th class="pb-3 font-medium">Tanggal & Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($recentLogs as $log)
                                    <tr>
                                        <td class="py-3">{{ $log->checked_in_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-6">Belum ada riwayat check-in.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode("#barcode", "{{ $member->barcode }}", {
            format: "CODE128",
            width: 1.8,
            height: 50,
            displayValue: false,
            background: "#ffffff",
            lineColor: "#000000",
        });
    </script>

</body>
</html>
