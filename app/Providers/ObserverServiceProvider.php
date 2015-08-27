<?php

namespace App\Providers;

use App\Observers\UploadObserver;
use App\Models\Upload;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Boot model observers.
     */
    public function boot()
    {
        Upload::observe(UploadObserver::class);
    }

    /**
     * Register service dependencies.
     */
    public function register()
    {
        //
    }
}
