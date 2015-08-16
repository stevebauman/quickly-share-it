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

// The batch resource
$router->resource('batch', 'BatchController', [
    'only' => [
        'create',
        'store',
    ],
]);

// Quick Create batch
$router->get('quick-create', [
    'as' => 'batch.quick',
    'uses' => 'BatchController@quick',
]);

// Display batch
$router->get('{session_id}-{time}-{name}', [
    'as' => 'batch.show',
    'uses' => 'BatchController@show',
]);

// Edit Batch
$router->get('{session_id}-{time}-{name}/edit', [
    'as' => 'batch.edit',
    'uses' => 'BatchController@edit',
]);

// Download all files in a batch
$router->get('{session_id}-{time}-{name}/download', [
    'as' => 'batch.download',
    'uses' => 'BatchController@download',
]);

// Display a file in a batch
$router->get('{session_id}-{time}-{name}/{upload}-{file_name}', [
    'as' => 'batch.file.show',
    'uses' => 'BatchFileController@show',
]);

$router->post('upload/{session_id}-{time}-{name}', [
    'as' => 'upload.perform',
    'uses' => 'UploadController@perform',
]);

