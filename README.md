Yasumi
==========

Yasumi (Japanese for Holiday) is a simple library to help you calculate the dates and titles of holidays and other 
special celebrations from various countries/states. Many services exist on the internet that provide holidays, however
are either not free or offer only a limited set of information. In addition, no good PHP library seems to exist today
except maybe PEAR's Date_Holidays which hasn't been updated for a while.

The goal of Yasumi is to be powerful while remaining lightweight, by utilizing PHP native classes wherever possible.
Yasumi's calculation is provider-based (i.e. country/state) so it is easy to add new providers that calculate a 
country's holidays. The methods of the class can be used to get a holiday's date and title in various languages.


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

* Base: For testing the base functionality of Yasumi
* Japan: For separately testing the Japan Holiday Provider
* Netherlands: For separately testing the Netherlands Holiday Provider


License
-------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/