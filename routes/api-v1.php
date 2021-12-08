<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RegisterController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [RegisterController::class, 'index'] )->name('api.v1.index');
Route::post('/register', [RegisterController::class, 'store'] )->name('api.v1.register');


// Route::get('categories', [CategoryController::class, 'index'])->name('api.v1.index');
// Route::post('categories', [CategoryController::class, 'store'])->name('api.v1.store');
// Route::get('categories/{category}', [CategoryController::class, 'show'])->name('api.v1.store');
// Route::put('categories/{category}', [CategoryController::class, 'update'])->name('api.v1.update');
// Route::delete('categories/{category}', [CategoryController::class, 'delete'])->name('api.v1.delete');

Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');
