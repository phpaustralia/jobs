<?php

Route::group(['namespace' => 'API\V1', 'prefix' => '/api/v1'], function () {

    Route::get('/jobs', 'JobsController@index');

    Route::get('/jobs/watching', 'JobsController@watching');

    Route::get('/jobs/owned', 'JobsController@owned');

    Route::get('/jobs/search', 'JobsController@search');
});