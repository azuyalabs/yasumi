<?php

// This file demonstrates the use of a customm Holiday provider. A custom holiday provider can be used for
// those scenarios where you would need only a subset of holidays of an existing provider. Or, if you you like to
// extend an existing provider with additional, non-standard holidays.

declare(strict_types=1);

require 'vendor/autoload.php';

/** Provider for all observed holidays by the NYSE (New York Stock Exchange)  */
class NYSE extends Yasumi\Provider\USA
{
    /**
     * Initialize holidays for the NYSE.
     *
     * @throws Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add Good Friday
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));

        // Remove Columbus Day and Veterans Day
        $this->removeHoliday('columbusDay');
        $this->removeHoliday('veteransDay');
    }
}

// Use the factory method to create a new holiday provider instance
$NYSEHolidays = Yasumi\Yasumi::create(NYSE::class, (int) date('Y'));

// We then can retrieve the NYSE observed holidays in the usual manner:
echo 'List of all the holiday names: '.PHP_EOL;
foreach ($NYSEHolidays->getHolidayNames() as $day) {
    echo $day.PHP_EOL;
}
echo PHP_EOL;

// Use the count() method to show how many holidays are returned
echo 'Number of defined holidays: '.$NYSEHolidays->count().PHP_EOL;
