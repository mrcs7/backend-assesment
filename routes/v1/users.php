<?php
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UsersController@index');
});
