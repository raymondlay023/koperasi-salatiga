<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\KoperasiMemberController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/testdata', [DashboardController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'check.role:1,2'])->group(function () {
    // Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/inventory/index', [InventoryController::class,'index'])->name('inventory.stock');
    Route::post('/additem', [InventoryController::class, 'store'])->name('inventory.store');
    Route::put('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

    Route::get('/penjualans', [PenjualanController::class,'penjualanindex'])->name('penjualan.index');
    Route::post('/penjualan', [PenjualanController::class, 'inputpenjualan'])->name('penjualan.store');
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    Route::get('/pembelians', [PembelianController::class,'pembelianindex'])->name('pembelian.index');
    Route::post('/pembelian', [PembelianController::class, 'inputpembelian'])->name('pembelian.store');
    Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');

    Route::get('/members', [KoperasiMemberController::class, 'index'])->name('member.index');
    Route::get('/members/create', [KoperasiMemberController::class, 'create'] )->name('member.create');
    Route::post('/members', [KoperasiMemberController::class, 'store'])->name('member.store');
    Route::put('/member/{id}', [KoperasiMemberController::class, 'update'])->name('member.update');
    Route::delete('/member/{id}', [KoperasiMemberController::class, 'destroy'])->name('member.destroy');

    Route::get('/pinjaman/index', [PinjamanController::class, 'index'])->name('pinjaman.index');
    Route::post('/pinjaman/store', [PinjamanController::class, 'store'])->name('pinjaman.store');
    // Route::put('pinjaman/{id}', [PinjamanController::class, 'update'])->name('pinjaman.update');
    Route::delete('pinjaman/{id}', [PinjamanController::class, 'destroy'])->name('pinjaman.destroy');
    Route::post('/pinjaman/bayar-proses', [PinjamanController::class, 'prosesbayar'])->name('pinjaman.bayarproses');
    Route::get('/pinjaman/list-transaction', [PinjamanController::class, 'transactionlist'])->name('list.pinjaman.transaction');
    // Route::put('pinjaman-transactions/{id}', [PinjamanController::class, 'updatePinjamanTransaction'])->name('pinjaman.transaction.update');
    Route::delete('pinjaman-transactions/{id}', [PinjamanController::class, 'destroyPinjamanTransaction'])->name('pinjaman.transaction.destroy');

    Route::get('/tabungan/index', [TabunganController::class, 'index'])->name('tabungan.index');
    Route::post('/tabungan/store', [TabunganController::class, 'store'])->name('tabungan.store');
    Route::get('/tabungan/store/page', [TabunganController::class, 'setortabungan'])->name('tabungan.setor');
    Route::post('/tabungan/store/insert', [TabunganController::class, 'setorinsert'])->name('tabungan.insert');
    Route::delete('tabungan/{id}', [TabunganController::class, 'destroy'])->name('tabungan.destroy');
    Route::get('/list/transaction/tabungan',[TabunganController::class, 'listtransaction'])->name('list.transaksi.tabungan');
    Route::delete('tabungan/list-transaction/{id}', [TabunganController::class, 'destroyTabunganTransaction'])->name('tabungan.transaction.destroy');

    Route::get('/laporantabungan/index',[TabunganController::class, 'indexlaporan'])->name('tabungan.laporan.index');
    Route::get('/laporantabungan/result',[TabunganController::class, 'laporantabungan'])->name('tabungan.laporan.result');

    Route::get('/laporanpinjaman/index', [PinjamanController::class, 'indexlaporan'])->name('pinjaman.laporan.index');
    Route::get('/laporanpinjaman/result', [PinjamanController::class, 'laporanpinjaman'])->name('pinjaman.laporan.result');

    Route::get('/laporan',[InventoryController::class, 'laporan'])->name('inventory.laporan.index');
    Route::get('/laporan/result',[InventoryController::class, 'laporanResult'])->name('inventory.laporan.result');

    Route::get('/laporan/sembako',[InventoryController::class, 'laporansembako'])->name('laporan.sembako');
    Route::get('/laporan/kedelai',[InventoryController::class, 'laporankedelai'])->name('laporan.kedelai');
    Route::get('/laporan/tahutempe',[InventoryController::class, 'laporantahutempe'])->name('laporan.tahu_tempe');

});

Route::middleware(['auth', 'check.role:1'])->group(function () {
    Route::get('users', [UserController::class, 'indexOwner'])->name('users.index');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{id}', [UserController::class, 'resetPassword'])->name('users.reset.password');
});

require __DIR__.'/auth.php';

