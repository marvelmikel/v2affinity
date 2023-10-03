<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Providers\VoyagerDummyServiceProvider;
use Modules\Admin\VoyagerServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $this->app->register(VoyagerServiceProvider::class);
        $this->app->register(VoyagerServiceProvider::class);
        $this->app->register(VoyagerDummyServiceProvider::class);
    }
}
