<?php

use App\Http\Controllers\API\NovelController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/novel/store', [NovelController::class, 'store'])->name('novel.store');
Route::get('/novel', [NovelController::class, 'index'])->name('novel.index');
Route::get('/novel/edit/{id}', [NovelController::class, 'edit'])->name('novel.edit');
Route::put('/novel/update/{id}', [NovelController::class, 'update'])->name('novel.update');
Route::delete('/novel/{id}', [NovelController::class, 'destroy'])->name('novel.delete');
