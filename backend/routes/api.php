<?php

use App\Http\Controllers\Advertisement\AdvertisementController;
use App\Http\Controllers\File\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function (Request $request) {
    return response()->json([
        'message' => 'Hello World!',
    ]);
});

Route::get('/index', [AdvertisementController::class, 'index'])->name('index');
Route::get('/show/{id}', [AdvertisementController::class, 'show'])->name('show');
Route::post('/create', [AdvertisementController::class, 'store'])->name('store');
Route::put('/update/{id}', [AdvertisementController::class, 'update'])->name('update');

Route::get('/image/public/{path}', [FileController::class, 'getImage'])->name('getImage');
