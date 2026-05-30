@extends('admin.layout')

@section('title', 'Edit Member')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 max-w-3xl">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Edit Member: {{ $member->name }}</h2>
        </div>

        <form action="{{ route('admin.members.update', $member) }}" method="POST" class="p-6 space-y-6">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $member->name) }}"
                           class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $member->email) }}"
                           class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                           class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Member <span class="text-red-500">*</span></label>
                    <select name="membership_type"
                            class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('membership_type') border-red-500 @enderror">
                        <option value="basic" {{ old('membership_type', $member->membership_type) == 'basic' ? 'selected' : '' }}>Basic</option>
                        <option value="premium" {{ old('membership_type', $member->membership_type) == 'premium' ? 'selected' : '' }}>Premium</option>
                        <option value="platinum" {{ old('membership_type', $member->membership_type) == 'platinum' ? 'selected' : '' }}>Platinum</option>
                    </select>
                    @error('membership_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status"
                            class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $member->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status', $member->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kuota Masuk</label>
                    <input type="number" name="quota" value="{{ old('quota', $member->quota) }}" min="0" max="999"
                           class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('quota') border-red-500 @enderror">
                    @error('quota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Bergabung <span class="text-red-500">*</span></label>
                    <input type="date" name="join_date" value="{{ old('join_date', $member->join_date->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('join_date') border-red-500 @enderror">
                    @error('join_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $member->expiry_date?->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('expiry_date') border-red-500 @enderror">
                    @error('expiry_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="address" rows="2"
                          class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('address') border-red-500 @enderror">{{ old('address', $member->address) }}</textarea>
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                <textarea name="notes" rows="3"
                          class="w-full rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:ring-red-500 focus:border-red-500 @error('notes') border-red-500 @enderror">{{ old('notes', $member->notes) }}</textarea>
                @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.members.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Batal</a>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
