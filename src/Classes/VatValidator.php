<?php

namespace AMBERSIVE\VatValidator\Classes;

use AMBERSIVE\VatValidator\Classes\VatCompany;
use AMBERSIVE\VatValidator\Classes\VatCountries;
use App;
use Cache;
use Illuminate\Validation\ValidationException;
use SoapClient;
use SoapFault;
use Str;

class VatValidator
{
    public SoapClient $client;
    public $mockedResult;

    public function __construct(SoapClient $client = null)
    {
        $this->client = $client === null ? new SoapClient(config('vat-validator.wsdl', 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl')) : $client;
    }

    public function setClient(SoapClient $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Returns a VatCompany data object if the vat id is not invalid at all.
     *
     * @param  mixed $vatId
     * @return VatCompany
     */
    public function check(String $vatId, bool $skipCheck = false): VatCompany
    {
        $vatId = str_replace([' ', '.', '-', ',', ', '], '', trim($vatId));
        $result = null;

        $requestParams = [
            'countryCode' => $this->getCountryCode($vatId),
            'vatNumber' => $this->getVatNumber($vatId),
        ];

        // Before trying to get the result from the vies service validate manually
        if (! VatCountries::checkByCountrieRules($vatId)) {
            $result = new VatCompany((object) ['valid' => false]);
        }

        if ($result !== null && $result->isValid() === false) {
            return $result;
        } else {
            $result = new VatCompany((object) ['valid' => true]);
        }

        if ($skipCheck === true) {
            return $result;
        }

        try {
            // Returns a mocked result if testmode is active

            $cachedResult = Cache::get("vatresult_${vatId}");

            if ($cachedResult !== null) {
                $result = $cachedResult;
            } else {
                $result = $this->client->checkVat($requestParams);
                Cache::forever("vatresult_${vatId}", $result);
            }

            $result = $this->client->checkVat($requestParams);
        } catch (SoapFault $e) {
            abort(400, $e->getMessage());
        }

        if ($result === null) {
            $result = new VatCompany((object) ['valid' => false]);
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
