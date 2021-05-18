<?php

Route::get('', 'Tag\IndexController');
Route::get('/{id}', 'Tag\ShowController')->name('tags.id');
