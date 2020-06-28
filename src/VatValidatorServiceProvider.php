<?php

namespace AMBERSIVE\VatValidator;

use App;
use Illuminate\Foundation\AliasLoader;

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
        $this->app->bind('vat-validator', \AMBERSIVE\VatValidator\Classes\VatValidator::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('VatValidator', \AMBERSIVE\VatValidator\Facades\VatValidatorFacade::class);
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
        ],'vat-validator');

        $this->mergeConfigFrom(
            __DIR__.'/Configs/vat-validator.php', 'vat-validator.php'
        );

    }

}
