<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\UnitedKingdom;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\UnitedKingdom;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in Scotland (United Kingdom).
 *
 * Scotland is a country that is part of the United Kingdom. It covers an area of 77,933 square kilometres
 * (30,090 sq mi), and has a population of 5,424,800. The capital is Edinburgh. Glasgow, Scotland's
 * largest city, is the fifth largest city in the United Kingdom.
 *
 * Bank and public holidays in Scotland are determined under the Banking and Financial Dealings Act 1971
 * and the St Andrew's Day Bank Holiday (Scotland) Act 2007. Unlike the rest of United Kingdom, most bank
 * holidays are not recognised as statutory public holidays in Scotland, as most public holidays are
 * determined by local authorities across Scotland.
 *
 * @see https://en.wikipedia.org/wiki/Scotland
 */
class Scotland extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GB-SCT';

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
        parent::initialize();

        // Add common holidays
        $this->calculateNewYearsHolidays();
        $this->calculateMayDayBankHoliday();
        $this->calculateSpringBankHoliday();
        $this->calculateSummerBankHoliday();

        // Add common Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        $this->calculateStAndrewsDay();
        $this->calculateChristmasHolidays(Holiday::TYPE_BANK);
    }

    public function getSources(): array
    {
        return ['https://en.wikipedia.org/wiki/Public_and_bank_holidays_in_Scotland'];
    }

    /**
     * The Summer Bank holiday, also known as the Late Summer bank holiday, is a time for people in the United Kingdom
     * to have a day off work or school. In Scotland it falls on the first Monday of August.
     *
     * @see https://www.timeanddate.com/holidays/uk/summer-bank-holiday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSummerBankHoliday(): void
    {
        if ($this->year < 1871) {
            return;
        }

        $this->addHoliday(new Holiday(
            'summerBankHoliday',
            ['en' => 'August Bank Holiday'],
            new DateTime("first monday of august $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        ));
    }

    /**
     * New Year's Day is a public holiday in the United Kingdom on January 1 each year. It marks
     * the start of the New Year in the Gregorian calendar. For many people have a quiet day on
     * January 1, which marks the end of the Christmas break before they return to work.
     *
     * In Scotland, January 2 is also a bank holiday. If January 2 falls on a Saturday, the following Monday is a bank holiday.
     * If New Years Day falls on a Saturday, the following Monday and Tuesday are bank holidays.
     *
     * @see https://www.timeanddate.com/holidays/uk/new-year-day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNewYearsHolidays(): void
    {
        // Before 1871 it was not an observed or statutory holiday
        if ($this->year < 1871) {
            return;
        }

        $type = Holiday::TYPE_BANK;
        if ($this->year <= 1974) {
            $type = Holiday::TYPE_OBSERVANCE;
        }

        $newYearsDay = $this->newYearsDay($this->year, $this->timezone, $this->locale, $type);
        $secondNewYearsDay = new Holiday(
            'secondNewYearsDay',
            [],
            new DateTime("$this->year-1-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            $type
        );

        $this->addHoliday($newYearsDay);
        $this->addHoliday($secondNewYearsDay);

        if (\in_array((int) $newYearsDay->format('w'), [0, 6], true)) {
            $date = clone $newYearsDay;
            $date->add(new DateInterval('P2D'));
            $this->addHoliday(new SubstituteHoliday(
                $newYearsDay,
                [],
                $date,
                $this->locale,
                $type
            ));
        }

        if (\in_array((int) $secondNewYearsDay->format('w'), [0, 6], true)) {
            $date = clone $secondNewYearsDay;
            $date->add(new DateInterval('P2D'));
            $this->addHoliday(new SubstituteHoliday(
                $secondNewYearsDay,
                [],
                $date,
                $this->locale,
                $type
            ));
        }
    }

    /**
     * St. Andrew's Day.
     *
     * Saint Andrew's Day is Scotland's national day, celebrated on 30 November.
     *
     * @see https://en.wikipedia.org/wiki/Saint_Andrew%27s_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     * @throws \Exception
     */
    private function calculateStAndrewsDay(): void
    {
        if ($this->year < 2007) {
            return;
        }
        $holiday = new Holiday(
            'stAndrewsDay',
            [],
            new DateTime($this->year.'-11-30', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        );

        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next monday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale,
                Holiday::TYPE_BANK
            ));
        }
    }
}
