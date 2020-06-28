<?php

namespace AMBERSIVE\VatValidadtor;

use Illuminate\Support\ServiceProvider;

use AMBERSIVE\VatValidator\Facades\VatValidator;

class VatValidadtorServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Facade

        $this->app->bind('vat-validator',function(){
            return new VatValidator();
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
            __DIR__.'/Configs/vat-validator.php'         => config_path('vat-validator..php'),
        ],'keepachangelog');

        $this->mergeConfigFrom(
            __DIR__.'/Configs/vat-validator..php', 'vat-validator..php'
        );

    }

}
