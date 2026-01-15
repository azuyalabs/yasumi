[![GitHub Release](https://img.shields.io/github/release/azuyalabs/yasumi.svg?style=flat-square)](https://github.com/azuyalabs/yasumi/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/azuyalabs/yasumi.svg?style=flat-square)](https://packagist.org/packages/azuyalabs/yasumi)
![Coding Standard](https://img.shields.io/github/actions/workflow/status/azuyalabs/yasumi/coding-standard.yml?label=Coding%20Standard&style=flat-square)
![Static analysis](https://img.shields.io/github/actions/workflow/status/azuyalabs/yasumi/static-analysis.yml?label=Static%20analysis&style=flat-square)
![Testing](https://img.shields.io/github/actions/workflow/status/azuyalabs/yasumi/testing.yml?label=Testing&style=flat-square)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

![Logo](https://www.yasumi.dev/assets/img/yasumi_logo.svg)

## Introduction

Yasumi (Japanese for 'Holiday'「休み」) is the easy PHP library that helps you retrieve the dates and names of holidays and
other special celebrations from various countries/states. It is calculation and rule driven avoiding the need of a
comprehensive database.

Many services exist that can provide holiday information, however are either not entirely free or only offer limited
information. In addition, no exhaustive PHP library exists today covering a wide range of holidays and
countries. [PEAR's Date_Holidays](https://pear.php.net/package/Date_Holidays) library was a similar attempt, however it
hasn't been updated for a long time.

## Requirements

Yasumi requires **PHP 8.2** or higher. The library supports PHP 8.2, 8.3, 8.4, and 8.5.

For detailed information about supported PHP versions and security updates, please refer to
the [SECURITY.md](SECURITY.md) file.

## Installation

Install Yasumi using [Composer](https://getcomposer.org):

```shell
+composer require azuyalabs/yasumi
```

## Quick Start

Here's a simple example to get you started:

```php
<?php

require 'vendor/autoload.php';

// Create a holiday provider for a specific country and year
$holidays = Yasumi\Yasumi::create('USA', 2026);

// Get all holidays for the year
foreach ($holidays as $holiday) {
    echo $holiday->getName() . ': ' . $holiday->format('Y-m-d') . PHP_EOL;
}

// Get a specific holiday
$independenceDay = $holidays->getHoliday('independenceDay');
echo $independenceDay->getName() . ' is on ' . $independenceDay->format('F j, Y') . PHP_EOL;

// Check if a date is a holiday
$newYearsDay = $holidays->getHoliday('newYearsDay');
if ($newYearsDay !== null) {
    echo 'New Year\'s Day is a holiday!' . PHP_EOL;
}
```

For more examples, check the [examples](examples/) directory in the repository.

## Highlights

The goal of Yasumi is to be powerful while remaining lightweight, by utilizing PHP native classes wherever possible.
Yasumi's calculation is provider-based (i.e. by country/state), making it easy to add new holiday providers that
calculate holidays.

- Pure PHP with a straightforward API
- Framework-agnostic
- Use of Providers to easily extend and expand new Holidays
- Common Holiday Providers (e.g. Christian Holidays)
- Accounts for the date/time when holidays have been officially established and/or abolished
- Filters enabling to easily select certain holiday types (Official, Observed, Bank, Seasonal or Other)
- Global Translations
- Time zone aware
- Implements [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) to easily process a provider's
  holidays
- Fully [documented](https://www.yasumi.dev)
- Fully unit tested
- [Composer](https://getcomposer.org) ready, [PSR-12](https://www.php-fig.org/psr/psr-12/)
  and [PSR-4](https://www.php-fig.org/psr/psr-4/) compliant

## Documentation

Yasumi’s documentation is available on [https://www.yasumi.dev](https://www.yasumi.dev). You will find all the necessary
information how to install Yasumi and also recipes how you can use Yasumi in your project.

## Contributing

Contributions are encouraged and welcome; I am always happy to get feedback or pull requests on GitHub :)
Create [GitHub Issues](https://github.com/azuyalabs/yasumi/issues) for bugs and new features and comment on the ones you
are interested in.

If you enjoy what I am making, an extra cup of coffee is very much appreciated :). Your support helps me to put more
time into Open-Source Software projects like this.

<a href="https://www.buymeacoffee.com/sachatelgenhof" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a>

## License

This project is open-sourced software licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
