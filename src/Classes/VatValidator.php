<?php

namespace AMBERSIVE\VatValidator\Classes;

use AMBERSIVE\VatValidator\Classes\VatCompany;
use App;
use Illuminate\Validation\ValidationException;
use SoapClient;
use SoapFault;

class VatValidator
{
    public SoapClient $client;

    public function __construct(SoapClient $client = null)
    {
        $client = null;
        $this->client = $client === null ? new SoapClient(config('vat-validator.wsdl', 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl')) : $client;
    }

    /**
     * Returns a VatCompany data object if the vat id is not invalid at all.
     *
     * @param  mixed $vatId
     * @return VatCompany
     */
    public function check(String $vatId): VatCompany
    {
        $vatId = str_replace([' ', '.', '-', ',', ', '], '', trim($vatId));

        $requestParams = [
            'countryCode' => $this->getCountryCode($vatId),
            'vatNumber' => $this->getVatNumber($vatId),
        ];

        try {
            $result = $this->client->checkVat($requestParams);
        } catch (SoapFault $e) {
            abort(400, $e->getMessage());
        }

        return new VatCompany($result);
    }

    /**
     * Return the country code of the vat id.
     *
     * @param  mixed $vatId
     * @return string
     */
    protected function getCountryCode(String $vatId): String
    {
        return substr($vatId, 0, 2);
    }

    /**
     * Returs the vat number.
     *
     * @param  mixed $vatId
     * @return string
     */
    protected function getVatNumber(String $vatId): String
    {
        return substr($vatId, 2);
    }
}
