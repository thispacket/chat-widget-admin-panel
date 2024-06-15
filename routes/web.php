<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('index');
});

Route::get('/chat', function () {
    return view('index');
});

Route::get('/chat/{any}', function () {
    return view('index');
});

Route::get('/', function () {
    return redirect('/chat');
});


