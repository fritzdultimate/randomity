<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard\Index;
use App\Livewire\Guest\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('landing');
Route::get('sign/up', Register::class)->name('register');
Route::get('sign/in', Login::class)->name('login');
Route::get('/account/recovery', ForgotPassword::class)->name('forgot-password');
Route::get('registration-success', function() {
    if(!session('account-registered')) {
        // route cannot be accessed
        return redirect()->route('link-expired');
    }
    return view('utils.registration-success');
})->name('registered');

Route::get('account/recovery/successful', function() {
    if(!session('password-success')) {
        // route cannot be accessed
        return redirect()->route('login');
    }
    return view('utils.password-changed');
})->name('password-changed');

Route::get('account/recovery/pending', function() {
    if(!session('recovery')) {
        // route cannot be accessed
        return redirect()->route('forgot-password');
    }
    return view('utils.account-recovery-pending');
})->name('account-recovery-pending');

Route::get('account/reset/password', ResetPassword::class)->name('account-reset-password');

Route::get('app/user/dashboard', Index::class)->name('dashboard');

Route::get('403/forbidden/expired', function() {
    return view('errors.link-expired');
})->name('link-expired');