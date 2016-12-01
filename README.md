[![Latest Stable Version](https://poser.pugx.org/azuyalabs/yasumi/v/stable.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![Total Downloads](https://poser.pugx.org/azuyalabs/yasumi/downloads.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![Latest Unstable Version](https://poser.pugx.org/azuyalabs/yasumi/v/unstable.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![License](https://poser.pugx.org/azuyalabs/yasumi/license.svg)](https://packagist.org/packages/azuyalabs/yasumi) [![Build Status](https://travis-ci.org/azuyalabs/yasumi.svg?branch=master)](https://travis-ci.org/azuyalabs/yasumi)
Yasumi
==========

Yasumi (Japanese for 'Holiday'「休み」) is an easy PHP library to help you calculate the dates and names of holidays and other
special celebrations from various countries/states. Many services exist on the internet that provide holidays, however
are either not free or offer only limited information. In addition, no complete PHP library seems to exist today
that covers a wide range of holidays and countries, except maybe [PEAR's Date_Holidays](https://pear.php.net/package/Date_Holidays)
which unfortunately hasn't been updated for a long time.

The goal of Yasumi is to be powerful while remaining lightweight, by utilizing PHP native classes wherever possible.
Yasumi's calculation is provider-based (i.e. by country/state) sos easy to add new holiday providers that calculate
holidays. The methods of Yasumi can be used to get a holiday's date and name in various languages.


Contents
==========
* [Highlights](#highlights)
* [System Requirements](#requirements)
* [Installation](#installation)
* [Basic Usage](#usage)
* [Testing](#testing)
* [Contributing](#contributing)
* [Credits](#credits)
* [License](#license)
* [Sources](#license)


Highlights<a name="highlights"></a>
-------

* Simple API
* Use of Providers to easily extend and expand new Holidays
* Common Holiday Providers
* Global Translations
* Implements ArrayIterator to easily process a provider's holidays
* Filters enabling to easily select certain holiday types (Official, Observed, Bank, Seasonal or Other)
* Fully documented
* Fully Unit tested
* Framework-agnostic
* Timezone aware; holidays are calculated for the timezone they apply to
* Accounts for the date/time when holidays have been officially established and/or abolished
* Composer ready, [PSR-2] compliant

Yasumi currently supports 63 holiday providers (24 countries and 39 sub-regions):

* Australia (including the sub-region Victoria)
* Austria
* Belgium
* Brazil
* Croatia
* Czech Republic
* Denmark
* Finland
* France (including the sub-regions Bas-Rhin, Haut-Rhin, Moselle)
* Germany (including the sub-regions Baden-Württemberg, Bavaria, Berlin, Brandenburg, Bremen, Hamburg, Hesse, Lower Saxony, Mecklenburg-Vorpommern, North Rhine-Westphalia, Rhineland-Palatinate, Saarland, Saxony, Saxony-Anhalt, Schleswig-Holstein, Thuringia)
* Greece
* Italy
* Japan
* Netherlands
* New Zealand
* Norway
* Poland
* Portugal
* Slovakia
* Spain (including the sub-regions Andalusia, Aragon, Asturias, Balearic Islands, Basque Country, Canary Islands, Cantabria, Castile and León, Castile-La Mancha, Catalonia, Ceuta, Madrid Autonomous Community, Extremadura, Galicia, La Rioja, Melilla, Navarra Chartered Community, Murcia Region, Valencian Community)
* Sweden
* United States
* Ukraine
* United Kingdom

Yasumi has the following filters to allow you to filter only certain type of holidays:

* Official
* Observed
* Bank
* Seasonal
* Other

Yasumi focuses initially on a country's official holidays and non-working days. If time permits, other type of holidays
will be added. The goal is to issue a new release every month and targeting to have at least 2 new holiday providers in
each release :)

### Roadmap

- Taiwan
- Canada
- India


System Requirements<a name="requirements"></a>
-------------------

You need **PHP >= 5.5.0** to use `azuyalabs/yasumi` but the latest stable version of PHP is recommended.
Yasumi is verified and tested on PHP 5.5, 5.6 and 7.0. Although Yasumi will work with PHP 5.5, only PHP version 5.6 or
higher is supported.


Installation<a name="installation"></a>
------------

Install `azuyalabs/yasumi` using Composer.

```
$ composer require azuyalabs/yasumi
```


Basic Usage<a name="usage"></a>
-------

```php
<?php
// Require the composer auto loader
require 'vendor/autoload.php';

use Yasumi\Filters\OfficialHolidaysFilter;
use Yasumi\Yasumi;

// Use the factory to create a new holiday provider instance
$holidays = Yasumi::create('USA', 2016);

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
// 'substituteHoliday:christmasDay'

// Get a list all of the holiday dates
foreach ($holidays->getHolidayDates() as $date) {
    echo $date . PHP_EOL;
}
// 2016-01-01
// 2016-01-18
// 2016-02-15
// 2016-05-30
// 2016-07-04
// 2016-09-05
// 2016-10-10
// 2016-11-11
// 2016-11-24
// 2016-12-25
// 2016-12-26

// Get a holiday object for Independence Day
$independenceDay = $holidays->getHoliday('independenceDay');

// Get the localized name
echo $independenceDay->getName() . PHP_EOL;
// 'Independence Day'

// Get the date
echo $independenceDay . PHP_EOL;
// '2016-07-04'

// Get the type of holiday
echo $independenceDay->getType() . PHP_EOL;
// 'national'

// Print the holiday as a JSON object
echo json_encode($independenceDay, JSON_PRETTY_PRINT);
// {
//    "shortName": "independenceDay",
//    "translations": {
//    "en_US": "Independence Day"
//    },
//    "date": "2016-07-04 00:00:00.000000",
//    "timezone_type": 3,
//    "timezone": "America\/New_York"
// }

// Retrieve only the official holidays for the Netherlands in 2014
$holidays = Yasumi::create('Netherlands', 2014);
$official = new OfficialHolidaysFilter($holidays->getIterator());
foreach ($official as $day) {
    echo $day->getName() . PHP_EOL;
}
// 'New Year's Day'
// 'Easter Sunday'
// 'Easter Monday'
// 'Kings Day'
// 'Ascension Day'
// 'Whitsunday'
// 'Whitmonday'
// 'Christmas'
// 'Boxing Day'

// Calculate number of business/working days until a date
$nextBusinessDay = Yasumi::nextWorkingDay('USA', new \DateTime('2016-07-01', new \DateTimeZone('America/New_York')));
echo $nextBusinessDay->format('Y-m-d') . PHP_EOL;
// 2016-07-05
```


Testing<a name="testing"></a>
-------

Yasumi has a [PHPUnit](https://phpunit.de/) test suite. To run the tests, run the following command from the project
folder:

``` bash
$ phpunit
```

Yasumi has over 1500 unit tests with multiple iterations of assertions. Since Yasumi is using randomized years for asserting
the holidays, multiple iterations of assertions are executed to ensure the holidays are calculated in a large number
of years.

The tests are organized in some test suites to make testing a bit more easier:

* "Base"          : For testing the base functionality of Yasumi
* "Australia"     : For separately testing the Australia Holiday Provider
* "Austria"       : For separately testing the Austria Holiday Provider
* "Belgium"       : For separately testing the Belgium Holiday Provider
* "Brazil"        : For separately testing the Brazil Holiday Provider
* "Croatia"       : For separately testing the Croatia Holiday Provider
* "CzechRepublic" : For separately testing the Czech Republic Holiday Provider
* "Denmark"       : For separately testing the Denmark Holiday Provider
* "Finland"       : For separately testing the Finland Holiday Provider
* "France"        : For separately testing the France Holiday Provider
* "Germany"       : For separately testing the Germany Holiday Provider
* "Greece"        : For separately testing the Greece Holiday Provider
* "Italy"         : For separately testing the Italy Holiday Provider
* "Japan"         : For separately testing the Japan Holiday Provider
* "Netherlands"   : For separately testing the Netherlands Holiday Provider
* "NewZealand"    : For separately testing the New Zealand Holiday Provider
* "Norway"        : For separately testing the Norway Holiday Provider
* "Poland"        : For separately testing the Poland Holiday Provider
* "Portugal"      : For separately testing the Portugal Holiday Provider
* "Slovakia"      : For separately testing the Slovakia Holiday Provider
* "Spain"         : For separately testing the Spain Holiday Provider
* "Sweden"        : For separately testing the Sweden Holiday Provider
* "USA"           : For separately testing the USA Holiday Provider
* "Ukraine"       : For separately testing the Ukraine Holiday Provider
* "UnitedKingdom" : For separately testing the United Kingdom Holiday Provider

## Testing

Run the tests with:

``` bash
$ composer test
```

or alternatively run with:

``` bash
$ vendor/bin/phpunit
```


Contributing<a name="contributing"></a>
-------

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


Credits<a name="credits"></a>
-------

- [Sacha Telgenhof](https://github.com/stelgenhof)
- [All Contributors](../../contributors)


License<a name="license"></a>
-------

Yasumi is open-sourced software licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.


[PSR-2]: http://www.php-fig.org/psr/psr-2/


Sources<a name="sources"></a>
-------

- [Wikipedia](https://en.wikipedia.org/wiki/Main_Page)
- [Timeanddate.com](http://www.timeanddate.com/)  
- [CLDR - Unicode Common Locale Data Repository](http://cldr.unicode.org/)  
