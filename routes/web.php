<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bug-simples', function () {
    throw new Exception('Erro de demonstração do Sentry nume rota GET');
});

Route::get('/bug-array', function () {
    $array = ['name' => 'João'];
    return $array['email'];
});

Route::get('/bug-loop', function () {
    while (true) { }
});

Route::get('/bug-tipo', function () {
    function sum(int $a, int $b) {
        return $a + $b;
    }

    return sum('um', 2);
});
