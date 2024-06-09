<?php

use App\Adapters\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Web route
 *
 * @author Thanh <danhthanh418@gmail.com>
 */
Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class)->only([
    'index', 'store', 'destroy',
]);
