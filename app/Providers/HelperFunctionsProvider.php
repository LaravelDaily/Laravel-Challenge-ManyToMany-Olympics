<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperFunctionsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // require all php files in Helpers directory
        foreach (glob(app_path() . '/Helpers/*Functions.php') as $filename) {
            require_once($filename);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
