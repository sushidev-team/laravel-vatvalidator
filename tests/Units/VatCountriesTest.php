<?php

use AMBERSIVE\Tests\TestCase;
use AMBERSIVE\VatValidator\Classes\VatCountries;

class VatCountriesTest extends TestCase
{
    private VatValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testIfATIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('ATU12345678'));
    }

    public function testIfBEIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('BE123456789'));
    }

    public function testIfBGIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('BG123456789'));
        $this->assertTrue(VatCountries::checkByCountrieRules('BG1234567890'));
    }

    public function testIfCYIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('CY12345678A'));
    }

    public function testIfCZIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('CZ12345678'));
        $this->assertTrue(VatCountries::checkByCountrieRules('CZ123456789'));
        $this->assertTrue(VatCountries::checkByCountrieRules('CZ1234567890'));
    }

    public function testIfDEIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('DE123456789'));
    }

    public function testIfDKIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('DK12345678'));
    }

    public function testIfEEIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('EE123456789'));
    }

    public function testIfELIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('EL123456789'));
    }

    public function testIfESIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('ES123456789'));
        $this->assertTrue(VatCountries::checkByCountrieRules('ESX2345678X'));
    }

    public function testIfFIIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('FI1234567-8'));
        $this->assertTrue(VatCountries::checkByCountrieRules('FI12345678'));
    }

    public function testIfFRIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('FR12123456789'));
    }

    public function testIfGBIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('GB123 4567 89'));
        $this->assertTrue(VatCountries::checkByCountrieRules('GBGD123'));
        $this->assertTrue(VatCountries::checkByCountrieRules('GBHA123'));
    }

    public function testIfHRIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('HR12345678901'));
    }

    public function testIfHUIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('HU12345678'));
    }

    public function testIfIEIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('IE1234567AB'));
        $this->assertTrue(VatCountries::checkByCountrieRules('IE1234567A'));
    }

    public function testIfITIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('IT12345678901'));
    }

    public function testIfLTIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('LT123456789'));
        $this->assertFalse(VatCountries::checkByCountrieRules('LT1234567890'));
        $this->assertTrue(VatCountries::checkByCountrieRules('LT123456789012'));
    }

    public function testIfLUIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('LU12345678'));
    }

    public function testIfLVIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('LV12345678901'));
    }

    public function testIfMTIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('MT12345678'));
    }

    public function testIfNLIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('NL123456789B12'));
    }

    public function testIfPLIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('PL1234567890'));
    }

    public function testIfPTIsValid():void
    {
        $this->assertTrue(VatCountries::checkByCountrieRules('PT123456789'));
    }

    public function testIfROIsValid():void
    {
        $this->assertFalse(VatCountries::checkByCountrieRules('RO2'));
        $this->assertTrue(VatCountries::checkByCountrieRules('RO22'));
        $this->assertTrue(VatCountries::checkByCountrieRules('RO1234567890'));
    }

    public function testIfSEIsValid():void
    {
        $this->assertFalse(VatCountries::checkByCountrieRules('SE1212345678'));
        $this->assertFalse(VatCountries::checkByCountrieRules('SE1212345678901'));
        $this->assertTrue(VatCountries::checkByCountrieRules('SE12123456789012'));
    }

    public function testIfSIIsValid():void
    {
        $this->assertFalse(VatCountries::checkByCountrieRules('SI123'));
        $this->assertFalse(VatCountries::checkByCountrieRules('SI12345'));
        $this->assertTrue(VatCountries::checkByCountrieRules('SI12345678'));
    }

    public function testIfSKIsValid():void
    {
        $this->assertFalse(VatCountries::checkByCountrieRules('SK123789'));
        $this->assertTrue(VatCountries::checkByCountrieRules('SK1234567890'));
        $this->assertTrue(VatCountries::checkByCountrieRules('SK123456789'));
    }
}
