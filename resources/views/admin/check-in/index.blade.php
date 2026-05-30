@extends('admin.layout')

@section('title', 'Check-In Member')

@section('content')
    <div class="max-w-lg mx-auto">
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-xl text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-xl text-center font-medium">
                {{ session('error') }}
            </div>
        @endif

        @if (isset($lookupError))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-xl text-center font-medium">
                {{ $lookupError }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Scan Barcode</h2>
            <form action="{{ route('admin.check-in.scan') }}" method="POST" class="space-y-4" id="scanForm">
                @csrf
                <input type="text" name="barcode" id="barcodeInput"
                       placeholder="Scan atau ketik barcode..."
                       class="w-full text-center text-lg tracking-widest uppercase rounded-xl border-gray-300 px-4 py-4 focus:ring-red-500 focus:border-red-500"
                       autofocus autocomplete="off">
                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-xl text-lg font-bold transition shadow-md">
                    Check-In
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Cari Member</h2>
            <form method="GET" action="{{ route('admin.check-in.lookup') }}" class="flex space-x-2">
                <input type="text" name="barcode" value="{{ request('barcode') }}"
                       placeholder="Masukkan barcode..."
                       class="flex-1 uppercase rounded-xl border-gray-300 px-4 py-3 focus:ring-red-500 focus:border-red-500">
                <button type="submit"
                        class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold transition">Cari</button>
            </form>
        </div>

        @if (isset($member))
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
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
        @endif
    </div>

    <script>
        document.getElementById('scanForm')?.addEventListener('submit', function() {
            document.getElementById('barcodeInput').value =
                document.getElementById('barcodeInput').value.toUpperCase();
        });
    </script>
@endsection
