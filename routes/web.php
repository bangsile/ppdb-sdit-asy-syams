<?php

use App\Livewire\FormPendaftaran;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
        return view('dashboard', compact('siswa'));
    })->name('dashboard');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');

    Route::get('form-pendaftaran', FormPendaftaran::class)->name('pendaftaran');
});

require __DIR__ . '/auth.php';
