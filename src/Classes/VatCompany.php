<?php

namespace AMBERSIVE\VatValidator\Classes;

class VatCompany
{
    private ?String $countryCode = '';
    private ?String $vatNumber = '';

    private bool $valid;
    private ?String $name = '';
    private ?String $address = '';

    public function __construct(object $data)
    {
        $this->countryCode = optional($data)->countryCode;
        $this->vatNumber = optional($data)->vatNumber;
        $this->valid = optional($data)->valid != null ? optional($data)->valid : false;
        $this->name = optional($data, )->name;
        $this->address = optional($data)->address;
    }

    /**
     * Return the coutry code.
     *
     * @return string
     */
    public function getCountry(): ?String
    {
        return $this->countryCode;
    }

    /**
     * Returns the Vat ID / Number.
     */
    public function getNumber(): ?String
    {
        return $this->vatNumber;
    }

    /**
     * Returns if the VAT Id is valid.
     */
    public function isValid():bool
    {
        return $this->valid;
    }

    /**
     * Returns the name of the company which is associated with this vat id.
     */
    public function getName(): ?String
    {
        return $this->name;
    }

    /**
     * Returns the address of the company which is associated with this vat id.
     */
    public function getAddress(): ?String
    {
        return $this->address;
    }
}
