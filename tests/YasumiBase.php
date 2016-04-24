<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests;

use DateTime;
use DateTimeZone;
use Faker\Factory as Faker;
use Yasumi\Filters\BankHolidaysFilter;
use Yasumi\Filters\ObservedHolidaysFilter;
use Yasumi\Filters\OfficialHolidaysFilter;
use Yasumi\Filters\OtherHolidaysFilter;
use Yasumi\Filters\SeasonalHolidaysFilter;
use Yasumi\Holiday;
use Yasumi\Yasumi;

/**
 * Trait YasumiBase.
 *
 * Trait containing some base function for testing Yasumi.
 */
trait YasumiBase
{
    /**
     * Asserts that the expected holidays are indeed a holiday for the given provider and year
     *
     * @param array  $expectedHolidays       list of all known holidays of the given provider
     * @param string $provider               the holiday provider (i.e. country/state) for which the holidays need to be
     *                                       tested
     * @param int    $year                   holiday calendar year
     * @param string $type                   The type of holiday. Use the following constants: TYPE_NATIONAL,
     *                                       TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER.
     */
    public function assertDefinedHolidays($expectedHolidays, $provider, $year, $type)
    {
        $holidays = Yasumi::create($provider, $year);

        switch ($type) {
            case Holiday::TYPE_NATIONAL:
                $holidays = new OfficialHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_OBSERVANCE:
                $holidays = new ObservedHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_SEASON:
                $holidays = new SeasonalHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_BANK:
                $holidays = new BankHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_OTHER:
                $holidays = new OtherHolidaysFilter($holidays->getIterator());
                break;
        }

        // Loop through all known holidays and assert they are defined by the provider class
        foreach ($expectedHolidays as $holiday) {
            $this->assertArrayHasKey($holiday, $holidays->getArrayCopy());
        }

        unset($holidays);
    }

    /**
     * Asserts that the expected date is indeed a holiday for that given year and name
     *
     * @param string   $provider  the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string   $shortName string the short name of the holiday to be checked against
     * @param int      $year      holiday calendar year
     * @param DateTime $expected  the date to be checked against
     */
    public function assertHoliday($provider, $shortName, $year, $expected)
    {
        $holidays = Yasumi::create($provider, $year);
        $holiday  = $holidays->getHoliday($shortName);

        $this->assertInstanceOf('Yasumi\Provider\\' . str_replace('/', '\\', $provider), $holidays);
        $this->assertInstanceOf('Yasumi\Holiday', $holiday);
        $this->assertTrue(isset($holiday));
        $this->assertEquals($expected, $holiday);
        $this->assertTrue($holidays->isHoliday($holiday));

        unset($holiday, $holidays);
    }

    /**
     * Asserts that the given holiday for that given year does not exist.
     *
     * @param string $provider  the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $shortName the short name of the holiday to be checked against
     * @param int    $year      holiday calendar year
     */
    public function assertNotHoliday($provider, $shortName, $year)
    {
        $holidays = Yasumi::create($provider, $year);
        $holiday  = $holidays->getHoliday($shortName);

        $this->assertInstanceOf('Yasumi\Provider\\' . str_replace('/', '\\', $provider), $holidays);
        $this->assertFalse(isset($holiday));
        $this->assertFalse($holidays->isHoliday($holiday));

        unset($holiday, $holidays);
    }

    /**
     * Asserts that the expected name is indeed provided as a translated holiday name for that given year and name
     *
     * @param string $provider     the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $shortName    string the short name of the holiday to be checked against
     * @param int    $year         holiday calendar year
     * @param array  $translations the translations to be checked against
     */
    public function assertTranslatedHolidayName($provider, $shortName, $year, $translations)
    {
        $holidays = Yasumi::create($provider, $year);
        $holiday  = $holidays->getHoliday($shortName);

        $this->assertInstanceOf('Yasumi\Provider\\' . str_replace('/', '\\', $provider), $holidays);
        $this->assertInstanceOf('Yasumi\Holiday', $holiday);
        $this->assertTrue(isset($holiday));
        $this->assertTrue($holidays->isHoliday($holiday));

        if (is_array($translations) && ! empty($translations)) {
            foreach ($translations as $locale => $name) {
                $translationExists = isset($holiday->translations[$locale]) ? true : false;

                $this->assertTrue($translationExists);
                $this->assertEquals($name, $holiday->translations[$locale]);
            }
        }

        unset($holiday, $holidays);
    }

    /**
     * Asserts that the expected type is indeed the associated type of the given holiday
     *
     * @param string $provider  the holiday provider (i.e. country/region) for which the holiday need to be tested
     * @param string $shortName string the short name of the holiday to be checked against
     * @param int    $year      holiday calendar year
     * @param string $type      the type to be checked against
     */
    public function assertHolidayType($provider, $shortName, $year, $type)
    {
        $holidays = Yasumi::create($provider, $year);
        $holiday  = $holidays->getHoliday($shortName);

        $this->assertInstanceOf('Yasumi\Provider\\' . str_replace('/', '\\', $provider), $holidays);
        $this->assertInstanceOf('Yasumi\Holiday', $holiday);
        $this->assertTrue(isset($holiday));
        $this->assertEquals($type, $holiday->getType());

        unset($holiday, $holidays);
    }


    /**
     * Returns a list of random test dates used for assertion of holidays.
     *
     * @param int    $month      month (number) for which the test date needs to be generated
     * @param int    $day        day (number) for which the test date needs to be generated
     * @param string $timezone   name of the timezone for which the dates need to be generated
     * @param int    $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array list of random test dates used for assertion of holidays.
     */
    public function generateRandomDates($month, $day, $timezone = 'UTC', $iterations = 10, $range = 1000)
    {
        $data = [];
        for ($y = 1; $y <= $iterations; $y++) {
            $year   = Faker::create()->dateTimeBetween("-$range years", "+$range years")->format('Y');
            $data[] = [$year, new DateTime("$year-$month-$day", new DateTimeZone($timezone))];
        }

        return $data;
    }

    /**
     * Generates a random year (number).
     *
     * @param int $lowerLimit the lower limit for generating a year number (default: 1000)
     * @param int $upperLimit the upper limit for generating a year number (default: 9999)
     *
     * @return int a year number
     */
    public function generateRandomYear($lowerLimit = 1000, $upperLimit = 9999)
    {
        return (int)Faker::create()->numberBetween($lowerLimit, $upperLimit);
    }
}
