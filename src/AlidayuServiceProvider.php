<?php

namespace iscms\Alidayu;

use Illuminate\Support\ServiceProvider;
use iscms\Alidayu\AlidayuService;

class AlidayuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/alidayu.php' => config_path('alidayu.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('alidayu', function () {
            return new AlidayuService(config('alidayu.accessKeyId'),config('alidayu.accessKeySecret'));
        });
    }
}
