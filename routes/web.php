<?php

Auth::routes();

Route::get('/deploy', [ 'middleware' => 'throttle:2', function () {

    $script = base_path('deploy.sh');

    chdir(base_path());

    exec("sh $script", $output, $code);

    return response(['output' => $output, 'code' => $code], 200);
}]);

Route::get('/', 'PagesController@welcome');

Auth::routes();

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index');

Route::resource('/jobs', 'JobsController');

Route::get('/jobs/{id}/approve/{value}', 'JobsController@approve');

Route::get('/jobs/{id}/watch', 'JobsController@watch');

Route::get('/jobs/{id}/unwatch', 'JobsController@unwatch');

Route::resource('/sponsors', 'SponsorsController');

Route::resource('/roles', 'RolesController');

Route::resource('/users', 'UsersController');

Route::resource('/files', 'FilesController');

Route::resource('/comments', 'CommentController');

Route::resource('/messages', 'MessagesController');

Route::get('/docs/{page}', [
    'as' => 'docs',
    'uses' => 'DocsController@show'
]);