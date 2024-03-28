<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('pages.produk.index');
// });

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/post-login', [LoginController::class, 'postLogin'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    Route::post('/post-logout', [LoginController::class, 'logOut'])->name('postLogout');
    
    Route::group(['middleware' => 'role:superadmin'], function () {
        Route::get('/dashboard-superadmin', [DashboardController::class, 'dashboard'])->name('superadmin');
    });
});
