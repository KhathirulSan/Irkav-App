<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoriController;
use App\Http\Controllers\KelAnggotaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/dashboard', function () {
    abort(404);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/inventori', function () {
    return view('admin.inventori');
})->name('inventori');

Route::get('/user/inventori', function () {
    return view('user.inventori');
})->name('user.inventori');

Route::get('/create', function () {
    return view('admin.inventori.create');
})->name('inventori.create');

Route::get('/inventori/save', function () {
    return view('admin.inventori.save');
})->name('inventori.save');

Route::get('/inventori/edit/{id}', function ($id) {
    return view('admin.inventori.edit', ['id' => $id]);
})->name('inventori.edit');

route::put('/inventori/update/{id}', function ($id) {
    return view('admin.inventori.update', ['id' => $id]);
})->name('inventori.update');

Route::delete('/inventori/delete/{id}', function ($id) {
    return view('admin.inventori.delete', ['id' => $id]);
})->name('inventori.delete');

Route::get('/inventori/cetak-inventori', function () {
    return view('admin.inventori.cetak-inventori');
})->name('inventori.cetak-inventori');

Route::get('/user/inventori/cetak-inventori', function () {
    return view('user.inventori.cetak-inventori');
})->name('user.inventori.cetak-inventori');

Route::get('/anggota', function () {
    return view('admin.anggota');
})->name('anggota');

Route::get('/anggota/create', function () {
    return view('admin.anggota.create');
})->name('anggota.create');

Route::get('/anggota/save', function () {
    return view('admin.anggota.save');
})->name('anggota.save');

Route::get('/surat', function () {
    return view('admin.surat');
})->name('surat');

Route::get('/surat/create', function () {
    return view('admin.surat.create');
})->name('surat.create');

Route::get('/surat/store', function () {
    return view('admin.surat.store');
})->name('surat.store');

Route::delete('/surat/delete/{id}', function ($id) {
    return view('admin.surat.delete', ['id' => $id]);
})->name('surat.delete');

Route::get('/surat/edit/{id}', function ($id) {
    return view('admin.surat.edit', ['id' => $id]);
})->name('surat.edit');

route::put('/surat/update/{id}', function ($id) {
    return view('admin.surat.update', ['id' => $id]);
})->name('surat.update');

Route::get('/surat/detail/{id}', function ($id) {
    return view('admin.surat.detail', ['id' => $id]);
})->name('surat.detail');
// Route::get('/inventori/downloadData', function () {
//     return view('admin.inventori.downloadData');
// })->name('inventori.downloadData');

// Route::get('/keuangan', function () {
//     return view('admin.keuangan.pemasukan');
// })->name('keuangan');

// Route::get('/keuangan/edit/{id}', function ($id) {
//     return view('admin.keuangan.pemasukan.edit', ['id' => $id]);
// })->name('keuangan.edit');

// Route::put('/keuangan/update/{id}', function ($id) {
//     return view('admin.keuangan.pemasukan.update', ['id' => $id]);
// })->name('keuangan.update');

Route::get('/keuangan/pemasukan', function () {
    return view('admin.keuangan.pemasukan');
})->name('keuangan.pemasukan');

Route::get('/keuangan/pemasukan/edit/{id}', function ($id) {
    return view('admin.keuangan.pemasukan.edit', ['id' => $id]);
})->name('keuangan.pemasukan.edit');

Route::put('/keuangan/pemasukan/update/{id}', function ($id) {
    return view('admin.keuangan.pemasukan.update', ['id' => $id]);
})->name('keuangan.pemasukan.update');


// RT ROUTE
Route::get('/rt/surat', function () {
    return view('rt.surat');
})->name('rt.surat');

Route::get('/rt/surat/detail/{id}', function ($id) {
    return view('rt.surat.detail', ['id' => $id]);
})->name('rt.surat.detail');

Route::get('/rt/surat/edit/{id}', function ($id) {
    return view('rt.surat.edit', ['id' => $id]);
})->name('rt.surat.edit');

Route::put('/rt/surat/detail/update/{id}', function ($id) {
    return view('rt.surat.detail.update', ['id' => $id]);
})->name('rt.surat.detail.update');

Route::get('/rt/surat/detail/save', function ($id) {
    return view('rt.surat.detail.save', ['id' => $id]);
})->name('rt.surat.detail.save');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::get('admin/inventori', [InventoriController::class, 'admin'])->name('admin.inventori');
    Route::get('admin/inventori/create', [InventoriController::class, 'create'])->name('admin/inventori/create');
    Route::post('admin/inventori/save', [InventoriController::class, 'save'])->name('admin/inventori/save');
    Route::get('admin/inventori/edit/{id}', [InventoriController::class, 'edit'])->name('admin/inventori/edit');
    Route::put('admin/inventori/edit/{id}', [InventoriController::class, 'update'])->name('admin/inventori/update');
    Route::get('admin/inventori/delete/{id}', [InventoriController::class, 'delete'])->name('admin/inventori/delete');
    Route::get('admin/inventori/cetak-inventori', [InventoriController::class, 'cetakData'])->name('admin/inventori/cetak-inventori');
    Route::get('admin/inventori/index', [InventoriController::class, 'index'])->name('admin/inventori/index');
    // Route::get('admin/inventori/downloadData', [InventoriController::class, 'downloadData'])->name('admin/inventori/downloadData');
    Route::get('admin/anggota', [KelAnggotaController::class, 'admin'])->name('admin.anggota');
    Route::get('admin/anggota/create', [KelAnggotaController::class, 'create'])->name('admin/anggota/create');
    Route::post('admin/anggota/save', [KelAnggotaController::class, 'save'])->name('admin/anggota/save');
    Route::get('admin/anggota/index', [KelAnggotaController::class, 'index'])->name('admin/anggota/index');
    Route::get('admin/surat', [SuratController::class, 'admin'])->name('admin.surat');
    Route::get('admin/surat/create', [SuratController::class, 'create'])->name('admin/surat/create');
    Route::post('admin/surat/store', [SuratController::class, 'store'])->name('admin/surat/store');
    Route::get('admin/surat/delete/{id}', [SuratController::class, 'delete'])->name('admin/surat/delete');
    Route::get('admin/surat/edit/{id}', [SuratController::class, 'edit'])->name('admin/surat/edit');
    Route::put('admin/surat/edit/{id}', [SuratController::class, 'update'])->name('admin/surat/update');
    Route::get('admin/surat/index', [SuratController::class, 'indexAdmin'])->name('admin/surat/index');
    Route::get('admin/surat/detail/{id}', [SuratController::class, 'detail'])->name('admin/surat/detail');
    Route::get('admin/surat/downloadPdf/{filename}', [SuratController::class, 'downloadPdf'])->name('admin/surat/downloadPdf');
    // Rute untuk menampilkan data gabungan anggota dan keuangan
    Route::get('admin/keuangan/pemasukan', [KeuanganController::class, 'index'])->name('admin.keuangan.pemasukan');
    Route::get('admin/keuangan/pemasukan/filter', [KeuanganController::class, 'index'])->name('admin.keuangan.pemasukan.index');
    Route::post('admin/keuangan/pemasukan/store', [KeuanganController::class, 'store'])->name('admin.keuangan.pemasukan.store');
    // Rute untuk mengubah status pembayaran dari "Belum Lunas" menjadi "Lunas"

    // Route::post('/admin/keuangan/edit/{id}', [KeuanganController::class, 'updateStatusPembayaran']);
    // Route::get('admin/kel-anggota/edit/{id}', [KelAnggotaController::class, 'edit'])->name('admin/kel-anggota/edit');
    // Route::put('admin/kel-anggota/edit/{id}', [KelAnggotaController::class, 'update'])->name('admin/kel-anggota/update');
    // Route::get('admin/kel-anggota/delete/{id}', [KelAnggotaController::class, 'delete'])->name('admin/kel-anggota/delete');
    // Route::get('admin/kel-anggota/cetak-kel-anggota', [KelAnggotaController::class, 'cetakData'])->name('admin/kel-anggota/cetak-kel-anggota');
});

Route::middleware(['auth', 'rt'])->group(function () {
    Route::get('rt/dashboard', [HomeController::class, 'rt'])->name('rt.dashboard');
    Route::get('rt/surat', [SuratController::class, 'rt'])->name('rt.surat');
    Route::get('rt/surat/detail/{id}', [SuratController::class, 'rtDetail'])->name('rt/surat/detail');
    Route::get('rt/surat/detail/edit/{id}', [SuratController::class, 'rtEdit'])->name('rt/surat/detail/edit');
    Route::put('rt/surat/detail/update/{id}', [SuratController::class, 'rtUpdate'])->name('rt/surat/detail/update');
    Route::get('rt/surat/detail/save', [SuratController::class, 'saveRT'])->name('rt/surat/detail/save');
    Route::get('rt/surat/index', [SuratController::class, 'indexRT'])->name('rt/surat/index');
    Route::get('rt/surat/downloadPdf/{filename}', [SuratController::class, 'downloadPdf'])->name('rt/surat/downloadPdf');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('user/dashboard', [HomeController::class, 'user'])->name('user.dashboard');
    Route::get('user/inventori', [InventoriController::class, 'user'])->name('user.inventori');
    Route::get('user/inventori/cetak-inventori', [InventoriController::class, 'cetakDataUser'])->name('user/inventori/cetak-inventori');
});
