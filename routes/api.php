<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Scrape;
use App\Http\Controllers\ScrapeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
require __DIR__.'/auth.php';

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::resource('categories',CategoryController::class);
// });

// Route::resource('categories',CategoryController::class);
// Route::prefix('/categories')->group(function () {
//     Route::get('',[CategoryController::class,'index']);           // GET /categories
//     Route::post('',[CategoryController::class,'store']);         // POST /categories
//     Route::put('/{category}',[CategoryController::class,'update']); // PUT /categories/{category}
//     Route::delete('/{category}',[CategoryController::class,'destroy']); // DELETE /categories/{category}
// });

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

Route::get('/gold/sudan', [ScrapeController::class, 'scrape'])->name("gold-prices");
