<?php

Route::get('', 'Article\IndexController')->name('articles.index');

Route::group(['middleware' => 'auth'], function () {
    Route::post('', 'Article\CreateController')
        ->name('articles.create');
    Route::get('/new', 'Article\NewController')
        ->name('articles.new');
    Route::get('/{id}/edit', 'Article\EditController')
        ->name('articles.edit');
    Route::patch('/{id}', 'Article\UpdateController')
        ->name('articles.update');
    Route::delete('/{id}', 'Article\DeleteController')
        ->name('articles.delete');
});

Route::get('/{id}', 'Article\ShowController')->name('articles.show');
