![Logo](https://github.com/azuyalabs/yasumi/blob/gh-pages/images/yasumi_logo_wb.png)

[![Total Downloads](https://img.shields.io/packagist/dt/azuyalabs/yasumi.svg?style=flat-square)](https://packagist.org/packages/azuyalabs/yasumi)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/azuyalabs/yasumi.svg?style=flat-square)](https://travis-ci.org/azuyalabs/yasumi)
[![StyleCI](https://styleci.io/repos/32797151/shield?branch=master)](https://styleci.io/repos/32797151)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/azuyalabs/yasumi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/azuyalabs/yasumi/?branch=master)


Important
----
This branch of Yasumi reflects the code up until version 1.8. With the release of Yasumi version 2.0, support for PHP 5 has ended. This code base serves as a support branch and will only receive the most critical bug fixes. Please note that v1.8.x works both in PHP 5 and PHP 7, but the code base hasn't been upgraded to PHP 7. 

It is highly recommended to upgrade to PHP7 and Yasumi v2.0.0 to enjoy the latest changes and improvements. More information can be found here: [Yasumi Release v2](https://azuyalabs.github.io/yasumi/blog/release_v2)

Introduction
------------
Yasumi (Japanese for 'Holiday'「休み」) is an easy PHP library to help you calculate the dates and names of holidays and other
special celebrations from various countries/states. Many services exist on the internet that provide holidays, however
are either not free or offer only limited information. In addition, no complete PHP library seems to exist today
that covers a wide range of holidays and countries, except maybe [PEAR's Date_Holidays](https://pear.php.net/package/Date_Holidays) which unfortunately hasn't been updated for a long time.

The goal of Yasumi is to be powerful while remaining lightweight, by utilizing PHP native classes wherever possible.
Yasumi's calculation is provider-based (i.e. by country/state) so it's easy to add new holiday providers that calculate
holidays. The methods of Yasumi can be used to get a holiday's date and name in various languages.

Documentation
-------------

Yasumi’s documentation is available on [https://azuyalabs.github.io/yasumi/](https://azuyalabs.github.io/yasumi/). You will find all the necessary information how to install Yasumi and also recipes how you can use Yasumi in your project.


License
-------

Yasumi is open-sourced software licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
