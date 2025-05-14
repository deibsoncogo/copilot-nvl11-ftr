<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\CustomerController;

Route::apiResource("customers", CustomerController::class);
