<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    $total_buku = \App\Models\Buku::count();
    $total_siswa = \App\Models\User::where('role', 'siswa')->count();
    $total_peminjaman = \App\Models\Peminjaman::count();

    return view('dashboard', compact('total_buku', 'total_siswa', 'total_peminjaman'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:siswa'])->group(function () {
    Route::get('/pinjam', [PeminjamanController::class, 'index'])->name('pinjam.index');
    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');
    Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])->name('riwayat');
    Route::post('/kembali/{id}', [PeminjamanController::class, 'kembali'])->name('kembali');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'adminIndex'])->name('admin.peminjaman.index');
    Route::get('/admin/peminjaman/cetak', [PeminjamanController::class, 'cetak'])->name('admin.peminjaman.cetak');
    Route::post('/admin/peminjaman/{id}/acc', [PeminjamanController::class, 'acc'])->name('admin.peminjaman.acc');
    Route::post('/admin/peminjaman/{id}/acc-kembali', [PeminjamanController::class, 'accKembali'])->name('admin.peminjaman.acc-kembali');
    Route::post('/admin/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('admin.peminjaman.tolak');
    Route::delete('/admin/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('admin.peminjaman.destroy');
    Route::resource('buku', BukuController::class);
    Route::resource('siswa', SiswaController::class)->names([
        'index' => 'admin.siswa.index',
        'create' => 'admin.siswa.create',
        'store' => 'admin.siswa.store',
        'show' => 'admin.siswa.show',
        'edit' => 'admin.siswa.edit',
        'update' => 'admin.siswa.update',
        'destroy' => 'admin.siswa.destroy',
    ]);
});

require __DIR__.'/auth.php';
