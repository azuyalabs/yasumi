<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in the United Kingdom. Local holidays/observances (e.g. Wales, England, Guernsey, etc.)
 * are not part of this provider.
 */
class UnitedKingdom extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GB';

    public $timezone = 'Europe/London';

    /**
     * Initialize holidays for the United Kingdom.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        // Add common holidays
        $this->calculateNewYearsDay();
        $this->calculateMayDayBankHoliday();
        $this->calculateSpringBankHoliday();
        $this->calculateSummerBankHoliday();

        // Add common Christian holidays (common in the United Kingdom)
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        $this->calculateChristmasHolidays();
    }

    /**
     * New Year's Day is a public holiday in the United Kingdom on January 1 each year. It marks
     * the start of the New Year in the Gregorian calendar. For many people have a quiet day on
     * January 1, which marks the end of the Christmas break before they return to work.
     *
     * If New Years Day falls on a Saturday or Sunday, it is observed the next Monday (January 2nd or 3rd)
     * Before 1871 it was not an observed or statutory holiday, after 1871 only an observed holiday.
     * Since 1974 (by Royal Proclamation) it was established as a bank holiday.
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_the_United_Kingdom
     * @link https://www.timeanddate.com/holidays/uk/new-year-day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateNewYearsDay(): void
    {
        // Before 1871 it was not an observed or statutory holiday
        if ($this->year < 1871) {
            return;
        }

        $type = Holiday::TYPE_BANK;
        if ($this->year <= 1974) {
            $type = Holiday::TYPE_OBSERVANCE;
        }

        $newYearsDay = new DateTime("$this->year-01-01", new DateTimeZone($this->timezone));

        // If New Years Day falls on a Saturday or Sunday, it is observed the next Monday (January 2nd or 3rd)
        if (\in_array((int)$newYearsDay->format('w'), [0, 6], true)) {
            $newYearsDay->modify('next monday');
        }

        $this->addHoliday(new Holiday('newYearsDay', [], $newYearsDay, $this->locale, $type));
    }

    /**
     * The first Monday of May is a bank holiday in the United Kingdom. It is called May Day in England, Wales and
     * Northern Ireland. It is known as the Early May Bank Holiday in Scotland. It probably originated as a Roman
     * festival honoring the beginning of the summer season (in the northern hemisphere). In more recent times, it has
     * been as a day to campaign for and celebrate workers' rights.
     *
     * The first Monday in May is a bank holiday and many people have a day off work. Many organizations, businesses
     * and schools are closed, while stores may be open or closed, according to local custom. Public transport systems
     * often run to a holiday timetable.
     *
     * @link https://www.timeanddate.com/holidays/uk/early-may-bank-holiday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateMayDayBankHoliday(): void
    {
        // From 1978, by Royal Proclamation annually
        if ($this->year < 1978) {
            return;
        }

        // Moved to 8 May to commemorate the 50th (1995) and 75th (2020) anniversary of VE Day.
        if (1995 === $this->year || 2020 === $this->year) {
            $this->addHoliday(new Holiday(
                'mayDayBankHoliday',
                ['en' => 'May Day Bank Holiday'],
                new DateTime("$this->year-5-8", new DateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_BANK
            ));

            return;
        }

        $this->addHoliday(new Holiday(
            'mayDayBankHoliday',
            ['en' => 'May Day Bank Holiday'],
            new DateTime("first monday of may $this->year", new DateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        ));
    }

    /**
     * The spring bank holiday, also known as the late May bank holiday, is a time for people in the United Kingdom to
     * have a day off work or school. It falls on the last Monday of May but it used to be on the Monday after
     * Pentecost.
     *
     * The last Monday in May is a bank holiday. Many organizations, businesses and schools are closed. Stores may be
     * open or closed, according to local custom. Public transport systems often run to a holiday timetable.
     *
     * @link https://www.timeanddate.com/holidays/uk/spring-bank-holiday
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_the_United_Kingdom
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateSpringBankHoliday(): void
    {
        // Statutory bank holiday from 1971, following a trial period from 1965 to 1970.
        if ($this->year < 1965) {
            return;
        }

        // Moved to 4 June for the celebration of the Golden (2002) and Diamond (2012) Jubilee
        // of Elizabeth II.
        if (2002 === $this->year || 2012 === $this->year) {
            $this->addHoliday(new Holiday(
                'springBankHoliday',
                ['en' => 'Spring Bank Holiday'],
                new DateTime("$this->year-6-4", new DateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_BANK
            ));

            return;
        }

        $this->addHoliday(new Holiday(
            'springBankHoliday',
            ['en' => 'Spring Bank Holiday'],
            new DateTime("last monday of may $this->year", new DateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        ));
    }

    /**
     * The Summer Bank holiday, also known as the Late Summer bank holiday, is a time for people in the United Kingdom
     * to have a day off work or school. It falls on the last Monday of August replacing the first Monday in August
     * (formerly commonly known as "August Bank Holiday").
     *
     * Many organizations, businesses and schools are closed. Stores may be open or closed, according to local custom.
     * Public transport systems often run to a holiday timetable.
     *
     * @link https://www.timeanddate.com/holidays/uk/summer-bank-holiday
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_the_United_Kingdom
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateSummerBankHoliday(): void
    {
        if ($this->year < 1871) {
            return;
        }

        if ($this->year < 1965) {
            $this->addHoliday(new Holiday(
                'summerBankHoliday',
                ['en' => 'August Bank Holiday'],
                new DateTime("first monday of august $this->year", new DateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_BANK
            ));

            return;
        }

        // Statutory bank holiday from 1971, following a trial period from 1965 to 1970.
        // During the trial period, the definition was different than today, causing exceptions
        // in 1968 and 1969.
        if (1968 === $this->year || 1969 === $this->year) {
            $this->addHoliday(new Holiday(
                'summerBankHoliday',
                ['en' => 'Summer Bank Holiday'],
                new DateTime("first monday of september $this->year", new DateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_BANK
            ));

            return;
        }

        $this->addHoliday(new Holiday(
            'summerBankHoliday',
            ['en' => 'Summer Bank Holiday'],
            new DateTime("last monday of august $this->year", new DateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        ));
    }

    /**
     * Christmas Day is celebrated in the United Kingdom on December 25. It traditionally celebrates Jesus Christ's
     * birth but many aspects of this holiday have pagan origins. Christmas is a time for many people to give and
     * receive gifts and prepare special festive meals.
     *
     * Boxing Day in the United Kingdom is the day after Christmas Day and falls on December 26. Traditionally, it was
     * a
     * day when employers distributed money, food, cloth (material) or other valuable goods to their employees.
     * In modern times, it is an important day for sporting events and the start of the post-Christmas sales.
     *
     * Boxing Day is a bank holiday. If Boxing Day falls on a Saturday, the following Monday is a bank holiday.
     * If Christmas Day falls on a Saturday, the following Monday and Tuesday are bank holidays. All schools and many
     * organizations are closed in this period. Some may close for the whole week between Christmas and New Year.
     *
     * @link https://www.timeanddate.com/holidays/uk/christmas-day
     * @link https://www.timeanddate.com/holidays/uk/boxing-day
     *
     * @param string|null $type the Holiday Type (e.g. Official, Seasonal, etc.)
     *
     * @throws \Exception
     */
    protected function calculateChristmasHolidays(?string $type = null): void
    {
        $christmasDay = $this->christmasDay($this->year, $this->timezone, $this->locale, $type ?? Holiday::TYPE_OFFICIAL);
        $secondChristmasDay = $this->secondChristmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK);

        $this->addHoliday($christmasDay);
        $this->addHoliday($secondChristmasDay);

        if (\in_array((int)$christmasDay->format('w'), [0, 6], true)) {
            $date = clone $christmasDay;
            $date->add(new DateInterval('P2D'));
            $this->addHoliday(new SubstituteHoliday(
                $christmasDay,
                [],
                $date,
                $this->locale,
                Holiday::TYPE_BANK
            ));
        }

        if (\in_array((int)$secondChristmasDay->format('w'), [0, 6], true)) {
            $date = clone $secondChristmasDay;
            $date->add(new DateInterval('P2D'));
            $this->addHoliday(new SubstituteHoliday(
                $secondChristmasDay,
                [],
                $date,
                $this->locale,
                Holiday::TYPE_BANK
            ));
        }
    }
}
