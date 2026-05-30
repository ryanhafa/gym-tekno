<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckInController extends Controller
{
    public function index(): View
    {
        return view('check-in.index');
    }

    public function scan(Request $request): RedirectResponse
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $member = Member::where('barcode', $request->barcode)->first();

        if (! $member) {
            return redirect()->route('check-in.index')
                ->with('error', 'Barcode tidak ditemukan.');
        }

        if ($member->status !== 'active') {
            return redirect()->route('check-in.index')
                ->with('error', 'Member dengan status '.$member->status.' tidak bisa check-in.');
        }

        if ($member->quota <= 0) {
            return redirect()->route('check-in.index')
                ->with('error', 'Kuota member '.$member->name.' sudah habis.');
        }

        $member->decrement('quota');

        AttendanceLog::create([
            'member_id' => $member->id,
            'barcode' => $request->barcode,
            'checked_in_at' => now(),
        ]);

        return redirect()->route('check-in.index')
            ->with('success', "Check-in berhasil! {$member->name} — Sisa kuota: {$member->fresh()->quota}");
    }

    public function lookup(Request $request): View
    {
        $member = Member::where('barcode', $request->barcode)->first();

        if (! $member) {
            return view('check-in.lookup', ['member' => null, 'error' => 'Barcode tidak ditemukan.']);
        }

        $recentLogs = AttendanceLog::where('member_id', $member->id)
            ->latest('checked_in_at')
            ->take(10)
            ->get();

        return view('check-in.lookup', compact('member', 'recentLogs'));
    }
}
