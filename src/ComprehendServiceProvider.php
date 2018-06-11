<?php

namespace MichaelJWright\Comprehend;

use Illuminate\Support\ServiceProvider;

class ComprehendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         $this->publishes([
            __DIR__ . '/config/main.php' => config_path('comprehend.php'),
        ]);

        $file = __DIR__ . '/../vendor/autoload.php';

        if (file_exists($file)) {
            require $file;
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('aws-comprehend', function() {
            return new Comprehend;
        });
    }
}
