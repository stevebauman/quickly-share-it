<?php

/*
|--------------------------------------------------------------------------
| Quickly Share It Routes
|--------------------------------------------------------------------------
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

// Batch routes
$router->group(['prefix' => '{batch_uuid}', 'as' => 'batch.'], function($router)
{
    // Display the gate for the batch
    $router->get('gate', [
        'as' => 'gate',
        'uses' => 'BatchAuthController@gate',
    ]);

    // Process unlocking the batch gate
    $router->post('gate/unlock', [
        'as' => 'gate.unlock',
        'uses' => 'BatchAuthController@unlock',
    ]);

    $router->group(['middleware' => ['batch.locked']], function ($router)
    {
        // Display batch
        $router->get('/', [
            'as' => 'show',
            'uses' => 'BatchController@show',
        ]);

        // Edit Batch
        $router->get('edit', [
            'as' => 'edit',
            'uses' => 'BatchController@edit',
        ]);

        // Download all files in a batch
        $router->get('download', [
            'as' => 'download',
            'uses' => 'BatchController@download',
        ]);

        // Perform a batch lock
        $router->post('lock', [
            'as' => 'lock',
            'uses' => 'BatchLockController@perform'
        ]);

        // Perform a batch upload
        $router->post('upload', [
            'as' => 'upload.perform',
            'uses' => 'UploadController@perform',
        ]);

        // Batch File Routes
        $router->group(['prefix' => 'files', 'as' => 'files.'], function ($router)
        {
            $router->group(['prefix' => '{file_uuid}'], function($router)
            {
                // Display a file in a batch
                $router->get('/', [
                    'as' => 'show',
                    'uses' => 'BatchFileController@show',
                ]);

                // Deletes a batch file
                $router->delete('/', [
                    'as' => 'destroy',
                    'uses' => 'BatchFileController@destroy',
                ]);

                // Download the specified file
                $router->get('download', [
                    'as' => 'download',
                    'uses' => 'BatchFileController@download',
                ]);
            });
        });
    });
});
