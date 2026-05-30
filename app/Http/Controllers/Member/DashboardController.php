<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $member = Auth::guard('members')->user();
        $recentLogs = $member->attendanceLogs()->latest('checked_in_at')->take(20)->get();

        return view('member.dashboard', compact('member', 'recentLogs'));
    }
}
