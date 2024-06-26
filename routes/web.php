<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\MemberController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/inventory/index', [InventoryController::class,'index'])->name('inventory.stock');
    Route::post('/additem', [InventoryController::class, 'store'])->name('inventory.store');
    Route::put('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

    Route::get('/penjualans', [PenjualanController::class,'penjualanindex'])->name('penjualan.index');
    Route::post('/penjualan', [PenjualanController::class, 'inputpenjualan'])->name('penjualan.store');
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'de\stroy'])->name('penjualan.destroy');

    Route::get('/pembelians', [PembelianController::class,'pembelianindex'])->name('pembelian.index');
    Route::post('/pembelian', [PembelianController::class, 'inputpembelian'])->name('pembelian.store');
});

require __DIR__.'/auth.php';



Route::get('/member/index', [MemberController::class, 'index'])->name('member.index');
Route::post('/members/store', [MemberController::class, 'store'])->name('members.store');
Route::get('/list/member-koperasi', [MemberController::class, 'listmember'] )->name('member.list');

Route::get('/test/{id}', [InventoryController::class,'transaction']);



Route::get('/pinjaman/index', [PinjamanController::class, 'index'])->name('pinjaman.index');



Route::get('/tabungan/index', [TabunganController::class, 'index'])->name('tabungan.index');
Route::post('/tabungan/store', [TabunganController::class, 'store'])->name('tabungan.store');
Route::get('/tabungan/store/page', [TabunganController::class, 'setortabungan'])->name('tabungan.setor');
Route::post('/tabungan/store/insert', [TabunganController::class, 'setorinsert'])->name('tabungan.insert');

Route::get('/list/transaction/tabungan',[TabunganController::class, 'listtransaction'])->name('list.transaksi.tabungan');
