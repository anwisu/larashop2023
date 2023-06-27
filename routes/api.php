<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/items',[ItemController::class,'index']);
Route::post('/items',[ItemController::class,'store']);
Route::get('/items/{id}/edit',[ItemController::class,'edit']);
Route::delete('/items/{id}',[ItemController::class,'destroy']);
Route::put('/items/{id}',[ItemController::class,'update']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
