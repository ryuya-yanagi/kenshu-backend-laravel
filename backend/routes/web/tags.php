<?php

Route::get('', 'Tag\IndexController')->name('tags.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/new', function () {
        return view('tags.new');
    });
    Route::post('', 'Tag\CreateController')->name('tags.create');
});

Route::get('/{id}', 'Tag\ShowController')->name('tags.show');
