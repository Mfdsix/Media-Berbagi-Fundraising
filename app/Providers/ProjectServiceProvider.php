<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Blade
use Illuminate\Support\Facades\Blade;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('projects', function () {

        });
        Blade::directive('endprojects', function () {

        });
    }
}
