<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::post('signup',[ApiController::class,'signup']);
Route::post('login',[ApiController::class,'login']);

Route::middleware('auth:sanctum')->group( function() {
	Route::get('/profile',[ApiController::class,'profile']);
});
