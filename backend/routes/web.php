<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('/mypage', 'Auth\CurrentUserInfoController')->name('mypage');

Route::prefix('users')->group(function () {
    require __DIR__ . '/web/users.php';
});

Route::prefix('auth')->group(function () {
    require __DIR__ . '/web/auth.php';
});

Route::prefix('articles')->group(function () {
    require __DIR__ . '/web/articles.php';
});

Route::prefix('tags')->group(function () {
    require __DIR__ . '/web/tags.php';
});
