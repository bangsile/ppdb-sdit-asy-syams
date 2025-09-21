<?php

use App\Livewire\DetailPendaftaran;
use App\Livewire\EditPendaftar;
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
    Route::get('pendaftaran/{no_pendaftaran}/detail', DetailPendaftaran::class)->name('pendaftaran.detail');
    Route::get('pendaftaran/{no_pendaftaran}/edit', EditPendaftar::class)->name('pendaftaran.edit');

    Route::get('berkas/{no_pendaftaran}/{nama_file}', function ($no_pendaftaran, $nama_file) {
        $user = Auth::user();
        $path = 'berkas-siswa/' . $no_pendaftaran . '/' . $nama_file;

        // Cek apakah file ada
        if (!Storage::exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        if ($user->getRoleNames()->first() == 'admin ') {
            return Storage::response('berkas-siswa/' . $no_pendaftaran . '/' . $nama_file);
        } else {
            $siswa = Siswa::where('no_pendaftaran', $no_pendaftaran)->firstOrFail();
            if ($siswa->user_id !== $user->id) {
                abort(404);
            }
            return Storage::response('berkas-siswa/' . $no_pendaftaran . '/' . $nama_file);
        }
    })->name('berkas.show');
});

require __DIR__ . '/auth.php';
