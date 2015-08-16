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

$router->get('/', [
    'as' => 'home.index',
    'uses' => 'HomeController@index',
]);

$router->resource('batch', 'BatchController', [
    'only' => [
        'create',
        'store',
    ],
]);

$router->get('quick-create', [
    'as' => 'batch.quick',
    'uses' => 'BatchController@quick',
]);

$router->get('{session_id}-{time}-{name}', [
    'as' => 'batch.show',
    'uses' => 'BatchController@show',
]);

$router->post('upload/{session_id}-{time}-{name}', [
    'as' => 'upload.perform',
    'uses' => 'UploadController@perform',
]);
