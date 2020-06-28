<?php

namespace AMBERSIVE\VatValidator;

use App;
use Validator;
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
        // Register the facade
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

        // Validation rules
        Validator::extend('vat_eu', function ($attribute, $value, $parameters, $validator) {
            try {
                $instance = new \AMBERSIVE\VatValidator\Classes\VatValidator();
                $result = $instance->check($value);
                return $result->isValid();
            } catch(\Symfony\Component\HttpKernel\Exception\HttpException $ex) {
                return false;
            }
        });

    }

}
