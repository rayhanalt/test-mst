<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\JenisUjianController;
use App\Http\Controllers\UbahProfileController;

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

// Login
Route::get('/loginpage', function () {
    return view('login');
})->name('login')->middleware('guest');

// login
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'auth');
    Route::get('/login', 'auth')->middleware('guest');

    Route::post('/logout', 'logout');
    Route::get('/logout', 'logout')->middleware('guest');
});

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

//ubah profil
Route::controller(UbahProfileController::class)->group(function () {
    //get route edit
    Route::get('user/edit/{user}', 'editUser')->middleware('auth');
    //admin
    Route::put('user/{user}', 'updateUser')->middleware('auth');
});

// Barang
Route::resource('/barang', BarangController::class)->except('show')->middleware('auth');


// Detail
Route::resource('/detail', DetailController::class)->except('show')->middleware('auth');

// Transaksi
Route::resource('/transaksi', TransaksiController::class)->except('show')->middleware('auth');
Route::controller(TransaksiController::class)->group(function () {
    // get detail transaksi
    Route::get('/get-option-details/{option}/{hasBarang}', 'getOptionDetails')->name('getOptionDetails')->middleware('auth');
});
// Customer
Route::resource('/customer', CustomerController::class)->except('show')->middleware('auth');
