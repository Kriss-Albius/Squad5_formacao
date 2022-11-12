<?php

use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardCommon;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
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
    return view('landing_page');
});

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/admin/dashboard', DashboardAdmin::class)->name('admin.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', DashboardCommon::class)->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');

    Route::post('/login', [LoginController::class, 'signin'])->name('login');
    Route::get('/login', [LoginController::class, 'login'])->name('login.form');
});

Route::get('/trail', function () {
    return view('trail');
});

Route::get('/main-dashboard', function () {
    return view('dashboard');
});
