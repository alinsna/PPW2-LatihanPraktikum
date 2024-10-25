<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
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
})->name('welcome');

Route::controller(LoginRegisterController::class)->group(function(){
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login')->middleware(Admin::class);
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('buku', BukuController::class);

Route::get('buku/index', [BukuController::class, 'index']);

Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');

Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');

Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

Route::get('restricted', function() {
    return redirect(route('dashboard'))->with('success', 'Anda berusia lebih dari 18 tahun!');
})->middleware('checkage');

Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
