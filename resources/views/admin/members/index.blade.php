@extends('admin.layout')

@section('title', 'Data Member')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Daftar Member</h2>
                <p class="text-sm text-gray-500 mt-1">Total: {{ $members->total() }} member</p>
            </div>
            <a href="{{ route('admin.members.create') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition inline-flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Member</span>
            </a>
        </div>

        <form method="GET" class="p-4 border-b border-gray-100 bg-gray-50">
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" placeholder="Cari nama, email, atau telepon..."
                       value="{{ request('search') }}"
                       class="flex-1 rounded-lg border-gray-300 px-4 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                <select name="status" class="rounded-lg border-gray-300 px-4 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
                <select name="membership_type" class="rounded-lg border-gray-300 px-4 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                    <option value="">Semua Tipe</option>
                    <option value="basic" {{ request('membership_type') == 'basic' ? 'selected' : '' }}>Basic</option>
                    <option value="premium" {{ request('membership_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                    <option value="platinum" {{ request('membership_type') == 'platinum' ? 'selected' : '' }}>Platinum</option>
                </select>
                <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-5 py-2 rounded-lg text-sm font-semibold transition">Filter</button>
                @if(request()->anyFilled(['search', 'status', 'membership_type']))
                    <a href="{{ route('admin.members.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 text-sm">Reset</a>
                @endif
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                        <th class="text-left px-6 py-4 font-semibold">Nama</th>
                        <th class="text-left px-6 py-4 font-semibold">Email</th>
                        <th class="text-left px-6 py-4 font-semibold">Telepon</th>
                        <th class="text-left px-6 py-4 font-semibold">Tipe</th>
                        <th class="text-left px-6 py-4 font-semibold">Status</th>
                        <th class="text-left px-6 py-4 font-semibold">Bergabung</th>
                        <th class="text-right px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($members as $member)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <a href="{{ route('admin.members.show', $member) }}" class="hover:text-red-600">{{ $member->name }}</a>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $member->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $member->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $member->membership_type === 'platinum' ? 'bg-purple-100 text-purple-800' : ($member->membership_type === 'premium' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($member->membership_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $member->status === 'active' ? 'bg-green-100 text-green-800' : ($member->status === 'suspended' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $member->join_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.members.show', $member) }}"
                                       class="text-gray-400 hover:text-blue-600 transition" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.members.edit', $member) }}"
                                       class="text-gray-400 hover:text-amber-600 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.members.destroy', $member) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus member {{ $member->name }}?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-sm">Belum ada data member.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($members->hasPages())
            <div class="p-6 border-t border-gray-100">
                {{ $members->links() }}
            </div>
        @endif
    </div>
@endsection
