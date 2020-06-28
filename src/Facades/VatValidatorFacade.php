<?php 

namespace AMBERSIVE\VatValidator\Facades;

use Illuminate\Support\Facades\Facade;

class VatValidadtorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vatvalidator';
    }
}