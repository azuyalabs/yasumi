[![Build Status](https://travis-ci.org/azuyalabs/yasumi.svg?branch=master)](https://travis-ci.org/azuyalabs/yasumi)
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
* Implements ArrayIterator to easily process a provider's holidays
* Fully documented
* Fully Unit tested
* Framework-agnostic
* Composer ready, [PSR-2] compliant

Currently the following holiday providers are implemented:

* Japan
* Netherlands

Documentation
-------

TBD


System Requirements
-------------------

You need **PHP >= 5.5.0** and the `intl` extension to use `azuyalabs/yasumi` but the latest stable
version of PHP is recommended.


Installation
------------

Install `azuyalabs/yasumi` using Composer.

```
$ composer require azuyalabs/yasumi
```


Testing
-------

Yasumi has a [PHPUnit](https://phpunit.de/) test suite. To run the tests, run the following command from the project folder:

``` bash
$ phpunit
```

The tests are organized in additional test suites:

* Base       : For testing the base functionality of Yasumi
* Japan      : For separately testing the Japan Holiday Provider
* Netherlands: For separately testing the Netherlands Holiday Provider


License
-------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/