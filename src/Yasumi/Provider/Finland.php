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

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Finland.
 */
class Finland extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'FI';

    /**
     * Initialize holidays for Finland.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Helsinki';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Finland)
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->calculateStJohnsDay(); // aka Midsummer's Day
        $this->calculateAllSaintsDay();
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateIndependenceDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Finland',
            'https://fi.wikipedia.org/wiki/Suomen_juhlap%C3%A4iv%C3%A4t',
        ];
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
     * In Finland since 1955, the holiday has always been on a Saturday (between June 20 and June 26). Earlier it was
     * always on June 24. Many of the celebrations of midsummer take place on midsummer eve, when many workplaces are
     * closed and shops must close their doors at noon.
     *
     * @see https://en.wikipedia.org/wiki/Midsummer#Finland
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStJohnsDay(): void
    {
        $stJohnsDay = $this->year < 1955 ? "$this->year-6-24" : "$this->year-6-20 this saturday";

        $this->addHoliday(new Holiday(
            'stJohnsDay',
            [],
            new DateTime($stJohnsDay, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * All Saints Day.
     *
     * All Saints' Day is a celebration of all Christian saints, particularly those who have no special feast days of
     * their own, in many Roman Catholic, Anglican and Protestant churches. In many western churches it is annually
     * held
     * November 1 and in many eastern churches it is celebrated on the first Sunday after Pentecost. It is also known
     * as All Hallows Tide, All-Hallomas, or All Hallows' Day.
     *
     * The festival was retained after the Reformation in the calendar of the Anglican Church and in many Lutheran
     * churches. In the Lutheran churches, such as the Church of Sweden, it assumes a role of general commemoration of
     * the dead. In the Swedish and Finnish calendar, the observance takes place on the Saturday between 31 October and
     * 6 November. In many Lutheran Churches, it is moved to the first Sunday of November.
     *
     * @see https://en.wikipedia.org/wiki/All_Saints%27_Day
     * @see https://fi.wikipedia.org/wiki/Pyh%C3%A4inp%C3%A4iv%C3%A4
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAllSaintsDay(): void
    {
        $this->addHoliday(new Holiday(
            'allSaintsDay',
            [],
            new DateTime("$this->year-10-31 this saturday", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Independence Day.
     *
     * Finland's Independence Day (Finnish: itsenäisyyspäivä, Swedish: självständighetsdagen) is a national public
     * holiday, and a flag day, held on 6 December to celebrate Finland's declaration of independence from the Russian
     * Republic in 1917.
     *
     * Independence Day was first celebrated in 1917. However, during the first years of independence, 6 December in
     * some parts of Finland was only a minor holiday compared to 16 May, the Whites' day of celebration for prevailing
     * in the Finnish Civil War.
     *
     * @see https://en.wikipedia.org/wiki/Independence_Day_(Finland)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1917) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['fi' => 'Itsenäisyyspäivä'],
                new DateTime("$this->year-12-6", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
