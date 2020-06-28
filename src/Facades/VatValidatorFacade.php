<?php 

namespace AMBERSIVE\VatValidator;

class VatValidadtorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vat-validator';
    }
}