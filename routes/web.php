<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
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
});

require __DIR__.'/auth.php';

Route::get('/inventory/index', [InventoryController::class,'index'])->name('inventory.stock');
Route::post('/additem', [InventoryController::class, 'store'])->name('inventory.store');

Route::get('/inventory/penjualan', [PenjualanController::class,'penjualanindex'])->name('inventory.penjualan.index');
Route::post('/penjualan', [PenjualanController::class, 'inputpenjualan'])->name('penjualan.store');

Route::get('/inventory/pembelian', [PembelianController::class,'pembelianindex'])->name('inventory.pembelian.index');
Route::post('/pembelian', [PembelianController::class, 'inputpembelian'])->name('pembelian.store');


Route::get('/member/index', [MemberController::class, 'index'])->name('member.index');
Route::post('/members/store', [MemberController::class, 'store'])->name('members.store');
Route::get('/list/member-koperasi', [MemberController::class, 'listmember'] )->name('member.list');
