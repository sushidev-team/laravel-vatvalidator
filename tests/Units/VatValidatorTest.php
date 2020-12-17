<?php

use AMBERSIVE\Tests\TestCase;
use AMBERSIVE\VatValidator\Classes\VatValidator;
use VatValidator as VV;

class VatValidatorTest extends TestCase
{
    private VatValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $mockedResult = [
            'countryCode'   =>  'AT',
            'vatNumber'     =>  'U69434328',
            'requestDate'   =>  '2020-07-10+02:00',
            'valid'         => false,
            'name'          => '---',
            'address'       => '---',
        ];

        $client = $this->getMockFromWsdl(
            __DIR__.'/../checkVatService.wsdl', 'checkVat'.md5(time().rand())
        );

        $client
            ->method('checkVat')
            ->willReturn((object) $mockedResult);

        $this->validator = new VatValidator($client);
    }

    /**
     * Test if the the method will throw an exeception cause the id complete wrong.
     */
    public function testIfVatValidatorThrowsExceptionIfInvalidVatId():void
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $result = $this->validator->check('TEST');
    }

    /**
     * Test if the vat return invalid if the id seems to be in the right structure but is wrong.
     */
    public function testIfVatValidatorWillNotThrowExeceptionIfTheVatIdIsWrong():void
    {
        $result = $this->validator->check('ATU69434328');
        $this->assertNotNull($result);
        $this->assertEquals(false, $result->isValid());
    }

    /**
     * Test if the validator returns the correct company profile.
     */
    public function testIfVatValidatorReturnsValidObject():void
    {
        $mockedResult = [
            'countryCode' => 'AT',
            'vatNumber'   => 'U69434329',
            'valid'   => true,
            'name'    => 'PICAPIPE GmbH',
            'address' =>  'Geylinggasse 15-17\\nAT-1130 Wien',
        ];

        $client = $this->getMockFromWsdl(
            __DIR__.'/../checkVatService.wsdl', 'checkVat'.md5(time().rand())
        );

        $client
            ->method('checkVat')
            ->willReturn((object) $mockedResult);

        $validator = new VatValidator($client);

        $result = $validator->check('ATU69434329');
        $this->assertNotNull($result);
        $this->assertEquals('AT', $result->getCountry());
        $this->assertEquals(true, $result->isValid());
        $this->assertEquals('PICAPIPE GmbH', $result->getName());
    }

    /**
     * Test if the Facade is working.
     */
    public function testIfFacadeIsWorking():void
    {
        $result = VV::check('ATU69434329');
        $this->assertEquals('AT', $result->getCountry());
        $this->assertEquals(true, $result->isValid());
        $this->assertEquals('PICAPIPE GmbH', $result->getName());
    }

    public function testIfValidationExtentionsWorks():void
    {

        // Prepare
        $data = [
            'vatid' => 'ATU69434329',
        ];

        $rules = [
            'vatid' => 'vat_eu',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertFalse($validator->fails());
    }

    public function testIfValidationExtentionsWorksButReturnsInvalid():void
    {

        // Prepare
        $data = [
            'vatid' => 'ATU69434328',
        ];

        $rules = [
            'vatid' => 'vat_eu',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertTrue($validator->fails());
    }

    public function testIfValidationExtentionsWorksButReturnsInvalidEvenIfPassedValueIsTotallyWrong():void
    {

        // Prepare
        $data = [
            'vatid' => 'XXX',
        ];

        $rules = [
            'vatid' => 'vat_eu',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertTrue($validator->fails());
    }

    public function testIfValidationExtensionWorksWithVatEuIf():void
    {

        // Prepare
        $data = [
            'vatid' => 'XXX',
            'company' => true,
        ];

        $rules = [
            'vatid' => 'vat_eu_if:company,true',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertTrue($validator->fails());
    }

    public function testIfValidadtionExtensionsIsValidIfRequiredIfIsFalse():void
    {

        // Prepare
        $data = [
            'vatid' => 'XXX',
            'company' => false,
        ];

        $rules = [
            'vatid' => 'vat_eu_if:company,true',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertFalse($validator->fails());
    }

    public function testIfValidationExtentionsVatEuAddressAndIfFailsIfCountryIsNotFromEU():void
    {

        // Prepare
        $data = [
            'vatid' => 'XXX',
            'company' => false,
            'country' => 'at',
        ];

        $rules = [
            'vatid' => 'vat_eu_address_and_if:country,company,true',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertFalse($validator->fails());
    }

    public function testIfValidationExtentinsVatEuIfThrowsExeception():void
    {

        // Prepare
        $data = [
            'vatid' => 'XXX',
            'company' => true,
        ];

        $rules = [
            'vatid' => 'vat_eu_if:company,true',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertTrue($validator->fails());
    }

    public function testIfValidationExtentinsVatEuIfWorksIfCompanyIsFalse():void
    {

        // Prepare
        $data = [
            'vatid' => 'XXX',
            'company' => false,
        ];

        $rules = [
            'vatid' => 'vat_eu_if:company,true',
        ];

        // Execute
        $validator = Validator::make($data, $rules);

        // Test
        $this->assertFalse($validator->fails());
    }
}
