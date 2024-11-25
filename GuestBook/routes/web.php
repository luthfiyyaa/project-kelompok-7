<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BalasanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('guest', GuestController::class);

Route::resource('pesan', PesanController::class);

Route::resource('admin', AdminController::class);

Route::resource('balasan', BalasanController::class);