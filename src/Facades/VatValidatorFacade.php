<?php 

namespace AMBERSIVE\VatValidator\Facades;

use Illuminate\Support\Facades\Facade;

class VatValidatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vat-validator';
    }
}