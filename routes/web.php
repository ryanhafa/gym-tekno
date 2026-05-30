<?php

use App\Http\Controllers\Admin\CheckInController as AdminCheckInController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\Member\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.authenticate');
    Route::get('/daftar', [RegisterController::class, 'create'])->name('register');
    Route::post('/daftar', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('members', MemberController::class);
    Route::prefix('check-in')->name('check-in.')->group(function () {
        Route::get('/', [AdminCheckInController::class, 'index'])->name('index');
        Route::post('/scan', [AdminCheckInController::class, 'scan'])->name('scan');
        Route::get('/lookup', [AdminCheckInController::class, 'lookup'])->name('lookup');
    });
});

Route::prefix('check-in')->name('check-in.')->group(function () {
    Route::get('/', [CheckInController::class, 'index'])->name('index');
    Route::post('/scan', [CheckInController::class, 'scan'])->name('scan');
    Route::get('/lookup', [CheckInController::class, 'lookup'])->name('lookup');
});

Route::prefix('member')->name('member.')->middleware('auth:members')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
