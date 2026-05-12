<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HelpController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/items/check-code', [ItemController::class, 'checkCode'])->name('items.check-code');
Route::resource('items', ItemController::class);
Route::resource('categories', CategoryController::class);
Route::get('/help', [HelpController::class, 'index'])->name('help');
