<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index']);

Route::get('/table_with_multiple_filter', [UserController::class, 'with_multiple_filter']);

/*Route::get('/', function () {
    return view('welcome');
});
*/