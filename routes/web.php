<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/metadata', function () {
    return view('metadata'); // Also uses same layout
});

Route::get('/login', function () {
    return view('login'); // Also uses same layout
});
