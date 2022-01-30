![Logo](https://www.yasumi.dev/assets/img/yasumi_logo.svg)

[![GitHub Release](https://img.shields.io/github/release/azuyalabs/yasumi.svg?style=flat-square)](https://github.com/azuyalabs/yasumi/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/azuyalabs/yasumi.svg?style=flat-square)](https://packagist.org/packages/azuyalabs/yasumi)
![Coding Standard](https://img.shields.io/github/workflow/status/azuyalabs/yasumi/Coding%20Standard?label=Coding%20Standard&style=flat-square)
![Static analysis](https://img.shields.io/github/workflow/status/azuyalabs/yasumi/Static%20analysis?label=Static%20analysis&style=flat-square)
![Testing](https://img.shields.io/github/workflow/status/azuyalabs/yasumi/Testing?label=Testing&style=flat-square)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

# Introduction

Yasumi (Japanese for 'Holiday'「休み」) is the easy PHP library that helps you retrieve the dates and names of holidays and
other special celebrations from various countries/states. It is calculation and rule driven avoiding the need of a
comprehensive database.

Many services exist that can provide holiday information, however are either not entirely free or only offer limited
information. In addition, no exhaustive PHP library exists today covering a wide range of holidays and
countries. [PEAR's Date_Holidays](https://pear.php.net/package/Date_Holidays) library was a similar attempt, however it
hasn't been updated for a long time.

# Highlights

The goal of Yasumi is to be powerful while remaining lightweight, by utilizing PHP native classes wherever possible.
Yasumi's calculation is provider-based (i.e. by country/state), making it easy to add new holiday providers that
calculate holidays.

- Straightforward API
- Framework-agnostic
- Use of Providers to easily extend and expand new Holidays
- Common Holiday Providers
- Accounts for the date/time when holidays have been officially established and/or abolished
- Filters enabling to easily select certain holiday types (Official, Observed, Bank, Seasonal or Other)
- Global Translations
- Timezone aware
- Implements [ArrayIterator](https://www.php.net/manual/en/class.arrayiterator.php) to easily process a provider's
  holidays
- Fully documented
- Fully unit tested
- [Composer](https://getcomposer.org) ready, [PSR-12](https://www.php-fig.org/psr/psr-12/)
  and [PSR-4](https://www.php-fig.org/psr/psr-4/) compliant

# Documentation

Yasumi’s documentation is available on [https://www.yasumi.dev](https://www.yasumi.dev). You will find all the necessary
information how to install Yasumi and also recipes how you can use Yasumi in your project.

# Blog

Checkout the [blog](https://www.yasumi.dev/blog/) section on documentation site regularly for latest updates. Keeping
you informed about any news, releases, etc. in a handy blog post format!

# Contributing

Contributions are encouraged and welcome; I am always happy to get feedback or pull requests on GitHub :)
Create [Github Issues](https://github.com/azuyalabs/yasumi/issues) for bugs and new features and comment on the ones you
are interested in.

If you enjoy what I am making, an extra cup of coffee is very much appreciated :). Your support helps me to put more
time into Open-Source Software projects like this.

<a href="https://www.buymeacoffee.com/sachatelgenhof" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a>

# License

Yasumi is open-source software licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
