<?php

Route::get('', 'Article\IndexController');
Route::middleware(['auth'])->group(function () {
    Route::get('/new', function () {
        return view('articles.new');
    });
    Route::post('/new', 'Article\CreateController');
});

Route::get('/{id}', 'Article\ShowController')->name('articles.id');
