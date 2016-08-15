<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Job;
use App\Post;

Route::get('/deploy', [ 'middleware' => 'throttle:2', function () {

  $script = base_path('deploy.sh');

  chdir(base_path());

  exec("sh $script", $output, $code);

  return response(['output' => $output, 'code' => $code], 200);

}]);

Route::get('/', 'PagesController@welcome');

Route::auth();

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

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

Route::group(['namespace' => 'API\V1', 'prefix' => '/api/v1'], function()
{
  Route::get('/jobs', 'JobsController@index');

  Route::get('/jobs/watching', 'JobsController@watching');

  Route::get('/jobs/owned', 'JobsController@owned');

  Route::get('/jobs/search', 'JobsController@search');
});

Route::get('/docs/{page}', [
  'as' => 'docs', 
  'uses' => 'DocsController@show'
]);


