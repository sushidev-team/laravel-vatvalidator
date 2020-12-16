<?php

namespace AMBERSIVE\VatValidator;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Validator;

class VatValidatorServiceProvider extends ServiceProvider
{
    public static $countries = [
        'be',
        'bg',
        'cz',
        'dk',
        'de',
        'ee',
        'ie',
        'el',
        'es',
        'fr',
        'hr',
        'it',
        'cy',
        'lv',
        'lt',
        'lu',
        'hu',
        'mt',
        'nl',
        'at',
        'pt',
        'ro',
        'si',
        'sk',
        'fi',
        'se',
    ];

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
        ], 'vat-validator');

        $this->mergeConfigFrom(
            __DIR__.'/Configs/vat-validator.php', 'vat-validator.php'
        );

        // Validation rules
        Validator::extend('vat_eu', function ($attribute, $value, $parameters, $validator) {
            try {
                $instance = new \AMBERSIVE\VatValidator\Classes\VatValidator();
                $result = $instance->check($value);

                return $result->isValid();
            } catch (\Symfony\Component\HttpKernel\Exception\HttpException $ex) {
                return false;
            }
        });

        Validator::extend('vat_eu_if', function ($attribute, $value, $parameters, $validator) {
            try {
                $data = $validator->getData();

                if (isset($data[$parameters[0]]) === false || $data[$parameters[0]] != $parameters[1]) {
                    return true;
                }

                $instance = new \AMBERSIVE\VatValidator\Classes\VatValidator();
                $result = $instance->check($value);

                return $result->isValid();
            } catch (\Symfony\Component\HttpKernel\Exception\HttpException $ex) {
                return false;
            }
        });

        Validator::extend('vat_eu_address_and_if', function ($attribute, $value, $parameters, $validator) {
            try {
                $data = $validator->getData();

                if (isset($data[$parameters[0]]) === false || isset($data[$parameters[1]]) === false) {
                    // Required fields does not exists in the provided input
                    return false;
                }

                if (in_array($data[$parameters[0]], static::$countries) === false) {
                    // Cannot find the country in the list of european countries
                    // This validator cannot check if the id is correct so mark it as true
                    return true;
                }

                if ($data[$parameters[1]] != $parameters[2]) {
                    return true;
                }

                $instance = new \AMBERSIVE\VatValidator\Classes\VatValidator();
                $result = $instance->check($value);

                return $result->isValid();
            } catch (\Symfony\Component\HttpKernel\Exception\HttpException $ex) {
                return false;
            }
        });
    }
}
