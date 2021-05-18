<?php

Route::get('', 'Article\IndexController');
Route::get('/new', 'Article\NewController');
Route::post('/new', 'Article\CreateController');
Route::get('/{id}', 'Article\ShowController')->name('articles.id');
