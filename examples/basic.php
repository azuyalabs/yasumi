<?php

// This file demonstrates the general use of Yasumi and its basic methods.

declare(strict_types=1);

require 'vendor/autoload.php';

// Use the factory to create a new holiday provider instance
$holidays = Yasumi\Yasumi::create('USA', (int) date('Y'));

// Show the number of defined holidays
echo 'Number of defined holidays: '.$holidays->count().PHP_EOL;
echo PHP_EOL;

// Display a list all of the holiday names (short names)
echo 'List of all the holiday names: '.PHP_EOL;
foreach ($holidays->getHolidayNames() as $name) {
    echo $name.PHP_EOL;
}
echo PHP_EOL;

// Display a list all of the holiday dates
echo 'List of all the holiday dates:'.PHP_EOL;
foreach ($holidays->getHolidayDates() as $date) {
    echo $date.PHP_EOL;
}
echo PHP_EOL;

// Get a holiday instance for Independence Day
$independenceDay = $holidays->getHoliday('independenceDay');

// Show the localized name
echo 'Name of the holiday : '.$independenceDay->getName().PHP_EOL;

// Show the date
echo 'Date of the holiday : '.$independenceDay.PHP_EOL;

// Show the type of holiday
echo 'Type of holiday     : '.$independenceDay->getType().PHP_EOL;
echo PHP_EOL;

// Dump the holiday as a JSON object
echo 'Holiday as a JSON object:'.PHP_EOL;
echo json_encode($independenceDay, JSON_PRETTY_PRINT);

echo PHP_EOL;
