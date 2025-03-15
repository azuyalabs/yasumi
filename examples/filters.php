<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

// This file demonstrates the use of filters; selecting only a number of holidays
// based on certain conditions. In this example we show only the holidays that are
// marked as 'official'.

require 'vendor/autoload.php';

// Use the factory to create a new holiday provider instance
$holidays = Yasumi\Yasumi::create('Netherlands', (int) date('Y'));

// Create a filter instance for the official holidays
$official = new Yasumi\Filters\OfficialHolidaysFilter($holidays->getIterator());

echo 'List of all official holidays: ' . PHP_EOL;
foreach ($official as $day) {
    echo $day->getName() . PHP_EOL;
}
