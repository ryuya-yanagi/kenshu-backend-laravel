<?php

Route::get('', 'Article\IndexController');
Route::post('', 'Article\CreateController')->middleware('can:article.create');
Route::get('/new', 'Article\NewController');
Route::get('/{id}', 'Article\ShowController')->name('articles.id');
Route::patch('/{id}', 'Article\UpdateController')->middleware('can:article.update,article');
Route::delete('/{id}', 'Article\DeleteController')->middleware('can:article.delete,article');
Route::get('/{id}/edit', 'Article\EditController')->middleware('can:article.update,article');
