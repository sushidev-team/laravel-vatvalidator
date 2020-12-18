<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VAT VALIDATOR SETTINGS
    |--------------------------------------------------------------------------
    |
    */

    'wsdl' => 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl',
    'testmode' => env('APP_ENV', 'production') === 'testing',
    'testmode_valid_vatid' => env('VAT_TESTMODE_VALID_ID', 'ATU69434329'),
];
