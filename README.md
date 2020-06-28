# VAT VALIDATOR

Validating the vat id from another company is a requirement within the european union.
This package validates the vat id + give you further information about the company behind the vat id.

## Installation

```bash
composer require ambersive/vatvalidator
```

#### Optional: Publish the config

```bash
php artisan vendor:publish --tag=vat-validator
```

## Usage

This package comes with a Facade so using this functionality if easy.

```php
use VatValidator;

$result = VatValidator::check("ATU69434329");
```

The result is typed an will return you a [VatCompany](src/Classes/VatCompany.php) Class.
This class offers you following methods:

```php
$result->isValid(); // Returns a boolean value
$result->getName(); // Returns the company name
$result->getAddress(); // Returns the company address
$result->getCountry(); // Returns the Country code
$result->getNumber(); // Returns the TAX number.
```

## Behind the scene

This package is using the CheckVat Service from the european union to check if a tax id is valid. It is a soap client, so make sure your server is ready for soap class.

## Feedback

Please feel free to give us feedback or any improvement suggestions.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Manuel Pirker-Ihl via [manuel.pirker-ihl@ambersive.com](mailto:manuel.pirker-ihl@ambersive.com). All security vulnerabilities will be promptly addressed.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
