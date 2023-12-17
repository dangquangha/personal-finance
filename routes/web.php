<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('packages')->group(function () {
    Route::get('/', [App\Http\Controllers\PackageController::class, 'index'])->name('packages');
    Route::get('/create', [App\Http\Controllers\PackageController::class, 'create'])->name('packages.create');
    Route::post('/store', [App\Http\Controllers\PackageController::class, 'store'])->name('packages.store');
    Route::get('/edit/{id}', [App\Http\Controllers\PackageController::class, 'edit'])->name('packages.edit');
    Route::post('/update/{id}', [App\Http\Controllers\PackageController::class, 'update'])->name('packages.update');
    Route::post('/destroy', [App\Http\Controllers\PackageController::class, 'destroy'])->name('packages.destroy');
});

Route::prefix('wallets')->group(function () {
    Route::get('/', [App\Http\Controllers\WalletController::class, 'index'])->name('wallets');
    Route::get('/create', [App\Http\Controllers\WalletController::class, 'create'])->name('wallets.create');
    Route::post('/store', [App\Http\Controllers\WalletController::class, 'store'])->name('wallets.store');
    Route::get('/edit/{id}', [App\Http\Controllers\WalletController::class, 'edit'])->name('wallets.edit');
    Route::post('/update/{id}', [App\Http\Controllers\WalletController::class, 'update'])->name('wallets.update');
    Route::post('/destroy', [App\Http\Controllers\WalletController::class, 'destroy'])->name('wallets.destroy');
});

Route::prefix('transactions')->group(function () {
    Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');
    Route::get('/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/store', [App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/edit/{id}', [App\Http\Controllers\TransactionController::class, 'edit'])->name('transactions.edit');
    Route::post('/update/{id}', [App\Http\Controllers\TransactionController::class, 'update'])->name('transactions.update');
});