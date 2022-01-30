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

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Sweden.
 */
class Sweden extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'SE';

    /**
     * Initialize holidays for Sweden.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Stockholm';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Sweden)
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->calculateEpiphanyEve();
        $this->calculateWalpurgisEve();
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->calculateStJohnsHolidays(); // aka Midsummer
        $this->calculateAllSaintsHolidays();
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        $this->addHoliday($this->newYearsEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateNationalDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Sweden',
            'https://sv.wikipedia.org/wiki/Helgdagar_i_Sverige',
        ];
    }

    /**
     * Epiphany Eve.
     *
     * Epiphany is a Christian feast day that celebrates the revelation of God the Son as a human being in Jesus Christ.
     * The traditional date for the feast is January 6. In Sweden the holiday is celebrated on the evening before, also
     * known as Twelfth Night.
     *
     * Epiphany Eve is often treated with the afternoon off, but this varies depending on employer.
     *
     * @see https://en.wikipedia.org/wiki/Twelfth_Night_(holiday)
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateEpiphanyEve(): void
    {
        $this->addHoliday(new Holiday(
            'epiphanyEve',
            [],
            new DateTime("$this->year-1-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * Walpurgis Night.
     *
     * Walpurgis Night is the eve of the Christian feast day of Saint Walpurga, an 8th-century abbess in Francia.
     * This feast commemorates the canonization of Saint Walpurga and the movement of her relics to Eichstätt,
     * both of which occurred on 1 May 870
     *
     * Walpurgis Night is often treated with the afternoon off, but this varies depending on employer.
     *
     * @see https://en.wikipedia.org/wiki/Walpurgis_Night
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateWalpurgisEve(): void
    {
        $this->addHoliday(new Holiday(
            'walpurgisEve',
            [],
            new DateTime("$this->year-4-30", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * St. John's Day / Midsummer.
     *
     * Midsummer, also known as St John's Day, is the period of time centred upon the summer solstice, and more
     * specifically the Northern European celebrations that accompany the actual solstice or take place on a day
     * between June 19 and June 25 and the preceding evening. The exact dates vary between different cultures.
     * The Christian Church designated June 24 as the feast day of the early Christian martyr St John the Baptist, and
     * the observance of St John's Day begins the evening before, known as St John's Eve.
     *
     * In Sweden the holiday has always been on a Saturday (between June 20 and June 26). Many of the celebrations of
     * midsummer take place on midsummer eve, when many workplaces are closed and shops must close their doors at noon.
     *
     * @see https://en.wikipedia.org/wiki/Midsummer#Sweden
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStJohnsHolidays(): void
    {
        $date = new DateTime("$this->year-6-20 this saturday", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'stJohnsDay',
            [],
            $date,
            $this->locale
        ));

        $date->sub(new DateInterval('P1D'));
        $this->addHoliday(new Holiday(
            'stJohnsEve',
            [],
            $date,
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * All Saints Day.
     *
     * All Saints' Day is a celebration of all Christian saints, particularly those who have no special feast days of
     * their own, in many Roman Catholic, Anglican and Protestant churches. In many western churches it is annually held
     * November 1 and in many eastern churches it is celebrated on the first Sunday after Pentecost. It is also known
     * as All Hallows Tide, All-Hallomas, or All Hallows' Day.
     *
     * The festival was retained after the Reformation in the calendar of the Anglican Church and in many Lutheran
     * churches. In the Lutheran churches, such as the Church of Sweden, it assumes a role of general commemoration of
     * the dead. In the Swedish calendar, the observance takes place on the Saturday between 31 October and 6 November.
     * In many Lutheran Churches, it is moved to the first Sunday of November.
     *
     * @see https://en.wikipedia.org/wiki/All_Saints%27_Day
     * @see https://www.timeanddate.com/holidays/sweden/all-saints-day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAllSaintsHolidays(): void
    {
        $date = new DateTime("$this->year-10-31 this saturday", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'allSaintsDay',
            [],
            $date,
            $this->locale
        ));

        $date->sub(new DateInterval('P1D'));
        $this->addHoliday(new Holiday(
            'allSaintsEve',
            [],
            $date,
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * National Day.
     *
     * National Day of Sweden (Sveriges nationaldag) is a national holiday observed in Sweden on 6 June every year.
     * Prior to 1983, the day was celebrated as Svenska flaggans dag (Swedish flag day). At that time, the day was
     * renamed to the national day by the Riksdag. The tradition of celebrating this date began 1916 at the Stockholm
     * Olympic Stadium, in honour of the election of King Gustav Vasa in 1523, as this was considered the foundation of
     * modern Sweden.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNationalDay(): void
    {
        if ($this->year < 1916) {
            return;
        }

        $holidayName = 'Svenska flaggans dag';

        // Since 1983 this day was named 'Sveriges nationaldag'
        if ($this->year >= 1983) {
            $holidayName = 'Sveriges nationaldag';
        }

        $this->addHoliday(new Holiday(
            'nationalDay',
            ['sv' => $holidayName],
            new DateTime("$this->year-6-6", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
