<?php

use Illuminate\Support\Facades\Route;



Route::resource('/inputs', \App\Http\Controllers\InputController::class);
Route::resource('tambahs', \App\Http\Controllers\TambahController::class);
