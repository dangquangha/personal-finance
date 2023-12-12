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

Route::get('/packages', [App\Http\Controllers\PackageController::class, 'index'])->name('packages');
Route::get('/packages/create', [App\Http\Controllers\PackageController::class, 'create'])->name('packages.create');
Route::post('/packages/store', [App\Http\Controllers\PackageController::class, 'store'])->name('packages.store');
Route::get('/packages/edit/{id}', [App\Http\Controllers\PackageController::class, 'edit'])->name('packages.edit');
Route::post('/packages/update/{id}', [App\Http\Controllers\PackageController::class, 'update'])->name('packages.update');
