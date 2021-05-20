<?php

Route::get('', 'Article\IndexController');

Route::group(['middleware' => 'auth'], function () {
    Route::post('', 'Article\CreateController');
    Route::get('/new', 'Article\NewController');
    Route::get('/{id}/edit', 'Article\EditController')
        ->name('edit');
    Route::patch('/{id}', 'Article\UpdateController')
        ->name('update');
    Route::delete('/{id}', 'Article\DeleteController')
        ->name('delete');
});

Route::get('/{id}', 'Article\ShowController')->name('articles.id');
