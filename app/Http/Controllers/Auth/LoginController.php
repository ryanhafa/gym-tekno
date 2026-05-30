<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $guards = [
            'web' => route('admin.members.index'),
            'members' => route('member.dashboard'),
        ];

        foreach ($guards as $guard => $redirect) {
            if (Auth::guard($guard)->attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ], $request->boolean('remember'))) {
                $request->session()->regenerate();

                return redirect()->intended($redirect);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $guards = ['web', 'members'];
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
