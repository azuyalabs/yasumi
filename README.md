[![Latest Stable Version](https://poser.pugx.org/azuyalabs/yasumi/v/stable.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![Total Downloads](https://poser.pugx.org/azuyalabs/yasumi/downloads.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![Latest Unstable Version](https://poser.pugx.org/azuyalabs/yasumi/v/unstable.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![License](https://poser.pugx.org/azuyalabs/yasumi/license.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![Build Status](https://travis-ci.org/azuyalabs/yasumi.svg?branch=master)](https://travis-ci.org/azuyalabs/yasumi)
Yasumi
==========

Yasumi (Japanese for Holiday) is an easy PHP library to help you calculate the dates and names of holidays and other
special celebrations from various countries/states. Many services exist on the internet that provide holidays, however
are either not free or offer only limited information. In addition, no complete PHP library seems to exist today
that covers a wide range of holidays and countries, except maybe PEAR's Date_Holidays which unfortunately hasn't been
updated for a while.

The goal of Yasumi is to be powerful while remaining lightweight, by utilizing PHP native classes wherever possible.
Yasumi's calculation is provider-based (i.e. by country/state) so it is easy to add new holiday providers that calculate
holidays. The methods of Yasumi can be used to get a holiday's date and name in various languages.


Highlights
-------

* Simple API
* Use of Providers to easily extend and expand new Holidays
* Common Holiday Providers
* Global Translations
* Implements ArrayIterator to easily process a provider's holidays
* Fully documented
* Fully Unit tested
* Framework-agnostic
* Composer ready, [PSR-2] compliant

Currently the following holiday providers are implemented:

* Japan
* Netherlands
* Belgium
* USA
* Italy


System Requirements
-------------------

You need **PHP >= 5.4.0** to use `azuyalabs/yasumi` but the latest stable version of PHP is recommended.


Installation
------------

Install `azuyalabs/yasumi` using Composer.

```
$ composer require azuyalabs/yasumi
```


Testing
-------

Yasumi has a [PHPUnit](https://phpunit.de/) test suite. To run the tests, run the following command from the project 
folder:

``` bash
$ phpunit
```

The tests are organized in some test suites to make testing a bit more easier:

* Base       : For testing the base functionality of Yasumi
* Japan      : For separately testing the Japan Holiday Provider
* Netherlands: For separately testing the Netherlands Holiday Provider
* Belgium    : For separately testing the Belgium Holiday Provider
* USA        : For separately testing the USA Holiday Provider
* Italy      : For separately testing the Italy Holiday Provider


Basic Usage
-------

```php
<?php
// Require the composer auto loader
require 'vendor/autoload.php';

use Yasumi\Yasumi;

// Use the factory to create a new holiday provider instance
$holidays = Yasumi::create('USA', 2015);

// Get the number of defined holidays
echo $holidays->count() . PHP_EOL;
// 11

// Get a list all of the holiday names (short names)
foreach ($holidays->getHolidayNames() as $name) {
    echo $name . PHP_EOL;
}
// 'newYearsDay'
// 'martinLutherKingDay'
// 'washingtonsBirthday'
// 'memorialDay'
// 'substituteHoliday:independenceDay'
// 'independenceDay'
// 'labourDay'
// 'columbusDay'
// 'veteransDay'
// 'thanksgivingDay'
// 'christmasDay'

// Get a list all of the holiday dates
foreach ($holidays->getHolidayDates() as $date) {
    echo $date . PHP_EOL;
}
// '2015-01-01'
// '2015-01-19'
// '2015-02-16'
// '2015-05-25'
// '2015-07-03'
// '2015-07-04'
// '2015-09-07'
// '2015-10-12'
// '2015-11-11'
// '2015-11-26'
// '2015-12-25'

// Get a holiday object for Independence Day
$independenceDay = $holidays->getHoliday('independenceDay');

// Get the localized name
echo $independenceDay->getName() . PHP_EOL;
// 'Independence Day'

// Get the date
echo $independenceDay . PHP_EOL;
// '2015-07-04'

// Get the type of holiday
echo $independenceDay->getType() . PHP_EOL;
// 'national'

// Print the holiday as a JSON object
echo json_encode($independenceDay, JSON_PRETTY_PRINT);
//{
//    "shortName": "independenceDay",
//    "translations": {
//    "en_US": "Independence Day"
//    },
//    "date": "2015-07-04 00:00:00.000000",
//    "timezone_type": 3,
//    "timezone": "America\/New_York"
//}
```


Roadmap
-------

Yasumi is still in development and a stable release is coming soon. For its first release, we will have the following
included:

- ~~Global Translations~~
- Filters
- ~~Common holiday providers~~
- Additional countries (~~Italy~~ and France)


License
-------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/