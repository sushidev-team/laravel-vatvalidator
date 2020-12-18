<?php

namespace AMBERSIVE\VatValidator\Classes;

use AMBERSIVE\VatValidator\Classes\VatCompany;
use App;
use Illuminate\Validation\ValidationException;
use Str;

class VatCountries
{
    public static $countries = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'EL',
        'ES',
        'FI',
        'FR',
        'GB',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PL',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];

    public static function checkByCountrieRules(String $vatId): bool
    {
        if (! in_array(substr($vatId, 0, 2), self::$countries)) {
            return false;
        }

        if (! method_exists(__CLASS__, 'check'.strtoupper(substr($vatId, 0, 2)))) {
            return false;
        }

        $methodName = 'check'.strtoupper(substr($vatId, 0, 2));

        return self::$methodName($vatId);
    }

    public static function checkAT($vatId):bool
    {
        $pattern = '/ATU[0-9]{8}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkBE($vatId):bool
    {
        $pattern = '/BE[0-9]{9}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkBG($vatId):bool
    {
        $pattern = '/BG[0-9]{9,10}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkCY($vatId):bool
    {
        $pattern = '/CY[0-9]{8,9}[A-Z]{0,1}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkCZ($vatId):bool
    {
        $pattern = '/CZ[0-9]{8,10}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkDE($vatId):bool
    {
        $pattern = '/DE[0-9]{9}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkDK($vatId):bool
    {
        $pattern = '/DK([0-9]{2}\s{0,}){4}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkEE($vatId):bool
    {
        $pattern = '/EE[0-9]{9}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkEL($vatId):bool
    {
        $pattern = '/EL[0-9]{9}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkES($vatId):bool
    {
        $pattern = '/ES[A-Z0-9a-z]{1}\d{7}[A-Z0-9a-z]{1}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkFI($vatId):bool
    {
        $pattern = '/FI[0-9]{7}[-0-9]{1,}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkFR($vatId):bool
    {
        $pattern = '/FR[0-9]{11}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkGB($vatId):bool
    {
        $pattern = '/GB([0-9]{3}|[A-Z]{2})\s?[\d]{3,4}\s?\d{0,2}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkHR($vatId):bool
    {
        $pattern = '/HR[0-9]{11}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkHU($vatId):bool
    {
        $pattern = '/HU[0-9]{8}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkIE($vatId):bool
    {
        $pattern = '/IE[0-9]{7}[0-9A-Z]{1,2}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkIT($vatId):bool
    {
        $pattern = '/IT[0-9]{11}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkLT($vatId):bool
    {
        $pattern1 = '/LT[0-9]{9}$/';
        $pattern2 = '/LT[0-9]{12}$/';

        return preg_match($pattern1, $vatId) == 1 || preg_match($pattern2, $vatId) == 1;
    }

    public static function checkLU($vatId):bool
    {
        $pattern = '/LU[0-9]{8}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkLV($vatId):bool
    {
        $pattern = '/LV[0-9]{11}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkMT($vatId):bool
    {
        $pattern = '/MT[0-9]{8}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkNL($vatId):bool
    {
        $pattern = '/NL[0-9A-Z+*]{12}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkPL($vatId):bool
    {
        $pattern = '/PL[0-9]{10}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkPT($vatId):bool
    {
        $pattern = '/PT[0-9]{9}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkRO($vatId):bool
    {
        $pattern = '/RO[0-9]{2,10}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkSE($vatId):bool
    {
        $pattern = '/SE[0-9]{14}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkSI($vatId):bool
    {
        $pattern = '/SI[0-9]{8}/';

        return preg_match($pattern, $vatId) == 1;
    }

    public static function checkSK($vatId):bool
    {
        $pattern = '/SK[0-9]{9,10}$/';

        return preg_match($pattern, $vatId) == 1;
    }
}
