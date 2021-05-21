<?php

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// コントローラー内で、middlewareを登録しているのでグループから排除
Route::post('/register', 'Auth\RegisterController')->name('register');
Route::post('/login', 'Auth\LoginController')->name('login');

Route::get('/logout', 'Auth\LogoutController')->name('logout');
