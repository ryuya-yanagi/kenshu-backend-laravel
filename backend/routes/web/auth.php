<?php

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('/register', function () {
        return view('auth.register');
    });
});

// コントローラー内で、guest middlewareを登録しているのでグループから排除
Route::post('/register', 'Auth\RegisterController');
Route::post('/login', 'Auth\LoginController');
