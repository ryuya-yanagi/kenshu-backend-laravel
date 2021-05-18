<?php

Route::get('', 'Article\IndexController');
Route::post('', 'Article\CreateController');
Route::get('/new', 'Article\NewController');
Route::get('/{id}', 'Article\ShowController')->name('articles.id');
Route::patch('/{id}', 'Article\UpdateController');
Route::delete('/{id}', 'Article\DeleteController');
Route::get('/{id}/edit', 'Article\EditController');
