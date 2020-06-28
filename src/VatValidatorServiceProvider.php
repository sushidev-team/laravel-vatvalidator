<?php

namespace AMBERSIVE\VatValidator;

use App;

use Illuminate\Support\ServiceProvider;

class VatValidatorServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Facade
        App::bind('test',function() {
            dd('test');
            return new \AMBERSIVE\VatValidator\Classes\VatValidator();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
        // Configs
        $this->publishes([
            __DIR__.'/Configs/vat-validator.php'         => config_path('vat-validator.php'),
        ],'keepachangelog');

        $this->mergeConfigFrom(
            __DIR__.'/Configs/vat-validator.php', 'vat-validator.php'
        );

    }

}
