<?php

// This file demonstrates the use of the `between` filter, selecting only a number of holidays
// that fall in the given date range.

declare(strict_types=1);

require 'vendor/autoload.php';

$year = (int) date('Y');

// Use the factory to create a new holiday provider instance
$holidays = Yasumi\Yasumi::create('Italy', $year);
$holidaysInDecember = $holidays->between(
    new DateTime('12/01/'.$year),
    new DateTime('12/31/'.$year)
);

// Show all holidays in Italy for December
echo 'List of all the holidays in December: '.PHP_EOL;
foreach ($holidaysInDecember as $holiday) {
    echo $holiday.' - '.$holiday->getName().PHP_EOL;
}
echo PHP_EOL;

// Show the number of filtered holidays
echo 'Number of filtered holidays: '.$holidaysInDecember->count().PHP_EOL;
