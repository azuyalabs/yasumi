<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests;

use DateTime;
use Faker\Factory as Faker;
use Yasumi\Yasumi;

/**
 * Trait YasumiBase.
 *
 * Trait containing some base function for testing Yasumi.
 */
trait YasumiBase
{

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

        $this->assertInstanceOf('Yasumi\Provider\\' . $provider, $holidays);
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

        $this->assertInstanceOf('Yasumi\Provider\\' . $provider, $holidays);
        $this->assertFalse(isset($holiday));
        $this->assertFalse($holidays->isHoliday($holiday));

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
        for ($y = 1; $y <= $iterations; $y ++) {
            $year   = Faker::create()->dateTimeBetween("-$range years", "+$range years")->format('Y');
            $data[] = [$year, new DateTime("$year-$month-$day", new \DateTimeZone($timezone))];
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
        return (int) Faker::create()->numberBetween($lowerLimit, $upperLimit);
    }
}
