<?php

Route::get('', 'User\IndexController')->name('users.index');
Route::get('/{id}', 'User\ShowController')->name('users.show');
