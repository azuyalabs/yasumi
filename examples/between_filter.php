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

// This file demonstrates the use of the `between` filter, selecting only a number of holidays
// that fall in the given date range.

require 'vendor/autoload.php';

$year = (int) date('Y');

// Use the factory to create a new holiday provider instance
$holidays = Yasumi\Yasumi::create('Italy', $year);
$holidaysInDecember = $holidays->between(
    new DateTime("12/01/{$year}"),
    new DateTime("12/31/{$year}")
);

// Show all holidays in Italy for December
echo 'List of all the holidays in December: ' . PHP_EOL;
foreach ($holidaysInDecember as $holiday) {
    echo $holiday . ' - ' . $holiday->getName() . PHP_EOL;
}
echo PHP_EOL;

// Show the number of filtered holidays
echo "Number of filtered holidays: {$holidaysInDecember->count()}" . PHP_EOL;
