<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
require __DIR__.'/auth.php';
Route::get('hello', function () {
    return [
        "messages" => "hello from backe-end ro front-end " , "from" => "Laravel backend" , "to" => "Angular Front end"
    ];
});
