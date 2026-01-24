<?php

use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\GoodController;
use App\Http\Controllers\api\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/goods', [GoodController::class,'index'])->name('goods');

Route::get('/locations', [LocationController::class, 'index'])->name('locations');

Route::get('/categories', [CategoryController::class,'index'])->name('categories');

Route::get('/animals', [AnimalController::class,'index'])->name('animals');