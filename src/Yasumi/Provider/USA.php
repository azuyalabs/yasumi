<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the USA.
 */
class USA extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'US';

    /**
     * Initialize holidays for the USA.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        $this->timezone = 'America/New_York';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        /**
         * Dr. Martin Luther King Day.
         *
         * Honors Dr. Martin Luther King, Jr., Civil Rights leader, who was actually born on January 15, 1929; combined
         * with other holidays in several states. It is observed on the third Monday of January since 1986.
         *
         * @link http://en.wikipedia.org/wiki/Martin_Luther_King,_Jr._Day
         */
        if ($this->year >= 1986) {
            $this->addHoliday(new Holiday('martinLutherKingDay', [
                'en_US' => 'Dr. Martin Luther King Jr\'s Birthday',
            ], new DateTime("third monday of january $this->year", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Washington's Birthday.
         *
         * Washington's Birthday is a United States federal holiday celebrated on the third Monday of February in honor
         * of George Washington, the first President of the United States. Colloquially, it is widely known as
         * Presidents Day and is often an occasion to remember all the presidents.
         *
         * Washington's Birthday was first declared a federal holiday by an 1879 act of Congress. The Uniform Holidays
         * Act, 1968 shifted the date of the commemoration of Washington's Birthday from February 22 to the third Monday
         * in February.
         *
         * @link http://en.wikipedia.org/wiki/Washington%27s_Birthday
         */
        if ($this->year >= 1879) {
            $date = new DateTime("$this->year-2-22", new DateTimeZone($this->timezone));
            if ($this->year >= 1968) {
                $date = new DateTime("third monday of february $this->year", new DateTimeZone($this->timezone));
            }
            $this->addHoliday(new Holiday('washingtonsBirthday', [
                'en_US' => 'Washington\'s Birthday',
            ], $date, $this->locale));
        }

        /**
         * Memorial Day.
         *
         * Honors the nation's war dead from the Civil War onwards; marks the unofficial beginning of the summer season.
         *
         * Memorial Day was first declared a federal holiday on May 1, 1865. The Uniform Holidays Act, 1968 shifted the
         * date of the commemoration of Memorial Day from May 30 to the last Monday in May.
         *
         * @link http://en.wikipedia.org/wiki/Memorial_Day
         */
        if ($this->year >= 1865) {
            $date = new DateTime("$this->year-5-30", new DateTimeZone($this->timezone));
            if ($this->year >= 1968) {
                $date = new DateTime("last monday of may $this->year", new DateTimeZone($this->timezone));
            }
            $this->addHoliday(new Holiday('memorialDay', [
                'en_US' => 'Memorial Day',
            ], $date, $this->locale));
        }

        /**
         * Independence Day.
         *
         * Independence Day, commonly known as the Fourth of July or July Fourth, is a federal holiday in the United
         * States commemorating the adoption of the Declaration of Independence on July 4, 1776, declaring independence
         * from Great Britain. In case Independence Day falls on a Sunday, a substituted holiday is observed the
         * following Monday. If it falls on a Saturday, a substituted holiday is observed the previous Friday.
         *
         * @link http://en.wikipedia.org/wiki/Independence_Day_(United_States)
         */
        if ($this->year >= 1776) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en_US' => 'Independence Day',
            ], new DateTime("$this->year-7-4", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Labour Day.
         *
         * Labor Day in the United States is a holiday celebrated on the first Monday in September. It is a celebration
         * of the American labor movement and is dedicated to the social and economic achievements of workers.
         *
         * @link http://en.wikipedia.org/wiki/Labor_Day
         */
        if ($this->year >= 1887) {
            $this->addHoliday(new Holiday(
                'labourDay',
                [
                'en_US' => 'Labour Day',
            ],
                new DateTime("first monday of september $this->year", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }

        /**
         * Columbus Day.
         *
         * Honors Christopher Columbus, traditional discoverer of the Americas. In some areas it is also a celebration
         * of Indigenous Peoples, or Italian culture and heritage. (traditionally October 12). Columbus Day first became
         * an official state holiday in Colorado in 1906, and became a federal holiday in the United States in 1937,
         * though people have celebrated Columbus's voyage since the colonial period. Since 1970 (Oct. 12), the holiday
         * has been fixed to the second Monday in October.
         *
         * @link http://en.wikipedia.org/wiki/Columbus_Day
         */
        if ($this->year >= 1937) {
            $date = new DateTime("$this->year-10-12", new DateTimeZone($this->timezone));
            if ($this->year >= 1970) {
                $date = new DateTime("second monday of october $this->year", new DateTimeZone($this->timezone));
            }
            $this->addHoliday(new Holiday('columbusDay', [
                'en_US' => 'Columbus Day',
            ], $date, $this->locale));
        }

        /**
         * Veterans Day.
         *
         * Veterans Day is an official United States holiday that honors people who have served in the U.S. Armed Forces
         * also known as veterans. It is a federal holiday that is observed on November 11 since 1919. Congress amended
         * a bill on June 1, 1954, replacing "Armistice" with "Veterans," and it has been known as Veterans Day since.
         *
         * @link http://en.wikipedia.org/wiki/Veterans_Day
         */
        if ($this->year >= 1919) {
            $name = ($this->year < 1954) ? 'Armistice Day' : 'Veterans Day';

            $this->addHoliday(new Holiday('veteransDay', [
                'en_US' => $name,
            ], new DateTime("$this->year-11-11", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Thanksgiving Day.
         *
         * Thanksgiving, or Thanksgiving Day, is a holiday celebrated in the United States on the fourth Thursday in
         * November. It has been celebrated as a federal holiday every year since 1863, when, during the Civil War,
         * President Abraham Lincoln proclaimed a national day of "Thanksgiving and Praise to our beneficent Father who
         * dwelleth in the Heavens", to be celebrated on the last Thursday in November.
         *
         * @link http://en.wikipedia.org/wiki/Thanksgiving_(United_States)
         */
        if ($this->year >= 1863) {
            $this->addHoliday(new Holiday(
                'thanksgivingDay',
                [
                'en_US' => 'Thanksgiving Day',
            ],
                new DateTime("fourth thursday of november $this->year", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }

        $this->calculateSubstituteHolidays();
    }

    /**
     * Calculate substitute holidays.
     *
     * When New Year's Day, Independence Day, or Christmas Day falls on a Saturday, the previous day is also a holiday.
     * When one of these holidays fall on a Sunday, the next day is also a holiday.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateSubstituteHolidays()
    {
        $datesIterator     = $this->getIterator();
        $substituteHoliday = null;

        // Loop through all defined holidays
        while ($datesIterator->valid()) {

            // Only process New Year's Day, Independence Day, or Christmas Day
            if (in_array(
                $datesIterator->current()->shortName,
                ['newYearsDay', 'independenceDay', 'christmasDay'],
                true
            )) {

                // Substitute holiday is on a Monday in case the holiday falls on a Sunday
                if (0 === (int)$datesIterator->current()->format('w')) {
                    $substituteHoliday = clone $datesIterator->current();
                    $substituteHoliday->add(new DateInterval('P1D'));
                }

                // Substitute holiday is on a Friday in case the holiday falls on a Saturday
                if (6 === (int)$datesIterator->current()->format('w')) {
                    $substituteHoliday = clone $datesIterator->current();
                    $substituteHoliday->sub(new DateInterval('P1D'));
                }

                // Add substitute holiday
                if (null !== $substituteHoliday) {
                    $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                        'en_US' => $substituteHoliday->getName() . ' observed',
                    ], $substituteHoliday, $this->locale));
                }
            }
            $datesIterator->next();
        }
    }
}
