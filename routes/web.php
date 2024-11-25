<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BalasanController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PesanController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });



route::get('/' , [FrontController::class, 'index'])->name('front.index');
route::get('/login-guest' , [FrontController::class, 'loginGuest'])->name('front.login-guest');
route::post('/guestlogin', [FrontController::class, 'guestLogin'])->name('front.guestLogin');
route::get('/login-admin' , [FrontController::class, 'loginAdmin'])->name('front.login-Admin');
route::post('/adminlogin', [FrontController::class, 'adminLogin'])->name('front.adminLogin');

route::get('/pesan',[FrontController::class,'pesan'])->name('front.pesan');

// Route::resource('balasan', BalasanController::class);

Route::get('/balasan/create/{pesan}', [BalasanController::class, 'create'])->name('balasan.create');
Route::post('/balasan/store', [BalasanController::class, 'store'])->name('balasan.store');

Route::resource('guest', GuestController::class);

Route::resource('pesan', PesanController::class);

Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/front/dashboard', [GuestController::class, 'dashboard'])->name('front.dashboard');
Route::get('/guest/pesan/{id}/edit', [GuestController::class, 'editPesan'])->name('guest.edit-pesan');
Route::put('/guest/pesan/{id}', [GuestController::class, 'updatePesan'])->name('guest.update-pesan');
Route::delete('/guest/pesan/{id}', [GuestController::class, 'deletePesan'])->name('guest.delete-pesan');