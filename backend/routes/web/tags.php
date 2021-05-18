<?php

Route::get('', 'Tag\IndexController');
Route::get('/new', function () {
    return view('tags.new');
})->middleware('auth');
Route::post('/new', 'Tag\CreateController');
Route::get('/{id}', 'Tag\ShowController')->name('tags.id');
