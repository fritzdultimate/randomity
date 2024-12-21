<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Index;
use App\Livewire\Guest\Home;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class);
Route::get('sign/up', Register::class)->name('register');
Route::get('sign/in', Login::class)->name('login');
Route::get('registration-success', function() {
    return view('utils.registration-success');
})->name('registered');

Route::get('app/user/dashboard', Index::class)->name('dashboard');