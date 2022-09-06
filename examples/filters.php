<?php

// This file demonstrates the use of filters; selecting only a number of holidays
// based on certain conditions. In this examples we show only the holidays that are
// marked as 'official'.

declare(strict_types=1);

require 'vendor/autoload.php';

// Use the factory to create a new holiday provider instance
$holidays = Yasumi\Yasumi::create('Netherlands', (int) date('Y'));

// Create a filter instance for the official holidays
$official = new Yasumi\Filters\OfficialHolidaysFilter($holidays->getIterator());

echo 'List of all official holidays: '.PHP_EOL;
foreach ($official as $day) {
    echo $day->getName().PHP_EOL;
}
