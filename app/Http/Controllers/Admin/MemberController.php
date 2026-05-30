<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $query = Member::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($type = $request->get('membership_type')) {
            $query->where('membership_type', $type);
        }

        $members = $query->latest()->paginate(10)->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'membership_type' => 'required|in:basic,premium,platinum',
            'status' => 'required|in:active,inactive,suspended',
            'quota' => 'nullable|integer|min:0|max:999',
            'join_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:join_date',
            'notes' => 'nullable|string',
        ]);

        $validated['barcode'] = Member::generateBarcode();
        $validated['quota'] ??= 30;

        Member::create($validated);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member berhasil ditambahkan.');
    }

    public function show(Member $member): View
    {
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member): View
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,'.$member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'membership_type' => 'required|in:basic,premium,platinum',
            'status' => 'required|in:active,inactive,suspended',
            'quota' => 'nullable|integer|min:0|max:999',
            'join_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:join_date',
            'notes' => 'nullable|string',
        ]);

        $member->update($validated);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member berhasil diperbarui.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member berhasil dihapus.');
    }
}
