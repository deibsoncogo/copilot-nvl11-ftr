<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

Route::apiResource("customers", CustomerController::class);
Route::apiResource("products", ProductController::class);
