@extends('admin.layout')

@section('title', 'Detail Member')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Detail Member</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.members.edit', $member) }}"
                       class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Edit</a>
                    <a href="{{ route('admin.members.index') }}"
                       class="text-gray-500 hover:text-gray-700 px-4 py-2 text-sm transition">Kembali</a>
                </div>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Nama</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $member->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $member->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Telepon</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $member->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Tipe Member</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $member->membership_type === 'platinum' ? 'bg-purple-100 text-purple-800' : ($member->membership_type === 'premium' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($member->membership_type) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $member->status === 'active' ? 'bg-green-100 text-green-800' : ($member->status === 'suspended' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Kuota Masuk</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center text-sm font-bold {{ $member->quota > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $member->quota }} / 30
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Tanggal Bergabung</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $member->join_date->format('d M Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider">Tanggal Berakhir</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $member->expiry_date?->format('d M Y') ?? '-' }}</dd>
                    </div>
                </dl>

                @if ($member->address)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Alamat</dt>
                        <dd class="text-sm text-gray-900">{{ $member->address }}</dd>
                    </div>
                @endif

                @if ($member->notes)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Catatan</dt>
                        <dd class="text-sm text-gray-900 whitespace-pre-line">{{ $member->notes }}</dd>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800">Kartu Member</h2>
            </div>
            <div class="p-6 flex flex-col items-center">
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

        @if ($member->attendanceLogs->isNotEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-8">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Riwayat Check-In</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                                <th class="text-left px-6 py-4 font-semibold">Tanggal</th>
                                <th class="text-left px-6 py-4 font-semibold">Waktu</th>
                                <th class="text-left px-6 py-4 font-semibold">Barcode</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($member->attendanceLogs()->latest('checked_in_at')->take(20)->get() as $log)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-900">{{ $log->checked_in_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $log->checked_in_at->format('H:i:s') }}</td>
                                    <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $log->barcode }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
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
@endpush
