<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in Kenya.
 *
 * Kenya's public holidays are established by the Public Holidays Act (Cap. 110).
 * Section 4 of the Act determines that whenever a public holiday falls on a Sunday,
 * the first succeeding day that is not itself a public holiday shall be a public
 * holiday.
 *
 * Note: The Islamic holidays Idd-ul-Fitr (Part I of the Schedule) and Idd-ul-Azha
 * (Part II of the Schedule) are not part of this provider yet. Their dates depend
 * on the sighting of the moon and are gazetted only shortly in advance. Islamic
 * holidays are quite complex and at first, an Islamic calendar provider needs to
 * be in place.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Kenya
 * @see https://new.kenyalaw.org/akn/ke/act/1912/21/
 */
class Kenya extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
     */
    public const ID = 'KE';

    /**
     * Year in which Kenya became a republic (12 December 1964). This provider
     * covers holidays from this year onwards.
     */
    public const ESTABLISHMENT_YEAR = 1964;

    /**
     * Initialize holidays for Kenya.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Africa/Nairobi';

        if ($this->year < self::ESTABLISHMENT_YEAR) {
            return;
        }

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale)); // Labour Day

        // Add common Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale)); // Boxing Day

        // Calculate other holidays
        $this->calculateMadarakaDay();
        $this->calculateMoiDay();
        $this->calculateUtamaduniDay();
        $this->calculateMazingiraDay();
        $this->calculateKenyattaDay();
        $this->calculateMashujaaDay();
        $this->calculateJamhuriDay();

        // Determine whether any of the holidays is substituted on another day
        $this->calculateSubstituteHolidays();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Kenya',
            'https://new.kenyalaw.org/akn/ke/act/1912/21/',
        ];
    }

    /**
     * Madaraka Day.
     *
     * "Siku ya Madaraka". Commemorates the day Kenya attained internal
     * self-rule on 1 June 1963, preceding full independence.
     *
     * @see https://en.wikipedia.org/wiki/Madaraka_Day
     *
     * @throws \Exception
     */
    protected function calculateMadarakaDay(): void
    {
        $this->addHoliday(new Holiday(
            'madarakaDay',
            ['en' => 'Madaraka Day', 'sw' => 'Siku ya Madaraka'],
            new \DateTime("{$this->year}-06-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Moi Day.
     *
     * "Siku ya Moi". Honoured the second president, Daniel arap Moi. First
     * observed on 10 October 1989 and removed from the list of public holidays
     * following the promulgation of the Constitution of Kenya in August 2010.
     * On 8 November 2017 the High Court ruled that its removal violated the
     * Public Holidays Act, restoring the holiday as of 2018. In 2020 it was
     * renamed Utamaduni Day.
     *
     * @see https://en.wikipedia.org/wiki/Moi_Day
     *
     * @throws \Exception
     */
    protected function calculateMoiDay(): void
    {
        if (($this->year >= 1989 && $this->year <= 2009) || 2018 === $this->year || 2019 === $this->year) {
            $this->addHoliday(new Holiday(
                'moiDay',
                ['en' => 'Moi Day', 'sw' => 'Siku ya Moi'],
                new \DateTime("{$this->year}-10-10", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Utamaduni Day.
     *
     * "Siku ya Utamaduni" (Culture Day). In 2020, Moi Day was renamed
     * Utamaduni Day to celebrate Kenya's rich cultural diversity. Renamed
     * Mazingira Day in 2024.
     *
     * @see https://en.wikipedia.org/wiki/Mazingira_Day
     *
     * @throws \Exception
     */
    protected function calculateUtamaduniDay(): void
    {
        if ($this->year >= 2020 && $this->year <= 2023) {
            $this->addHoliday(new Holiday(
                'utamaduniDay',
                ['en' => 'Utamaduni Day', 'sw' => 'Siku ya Utamaduni'],
                new \DateTime("{$this->year}-10-10", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Mazingira Day.
     *
     * "Siku ya Mazingira" (Environment Day). Utamaduni Day was renamed
     * Mazingira Day by the Statute Law (Miscellaneous Amendments) Act, 2024,
     * assented to on 24 April 2024. The day is dedicated to environmental
     * conservation activities such as tree planting.
     *
     * @see https://en.wikipedia.org/wiki/Mazingira_Day
     *
     * @throws \Exception
     */
    protected function calculateMazingiraDay(): void
    {
        if ($this->year >= 2024) {
            $this->addHoliday(new Holiday(
                'mazingiraDay',
                ['en' => 'Mazingira Day', 'sw' => 'Siku ya Mazingira'],
                new \DateTime("{$this->year}-10-10", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Kenyatta Day.
     *
     * "Siku ya Kenyatta". Commemorated the arrest of the Kapenguria Six,
     * among them Jomo Kenyatta, on 20 October 1952. Renamed Mashujaa Day
     * following the promulgation of the Constitution of Kenya in August 2010.
     *
     * @see https://en.wikipedia.org/wiki/Mashujaa_Day
     *
     * @throws \Exception
     */
    protected function calculateKenyattaDay(): void
    {
        if ($this->year <= 2009) {
            $this->addHoliday(new Holiday(
                'kenyattaDay',
                ['en' => 'Kenyatta Day', 'sw' => 'Siku ya Kenyatta'],
                new \DateTime("{$this->year}-10-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Mashujaa Day.
     *
     * "Siku ya Mashujaa" (Heroes' Day). Honours all those who contributed
     * towards the struggle for Kenya's independence or positively contributed
     * to post-independence Kenya. Known as Kenyatta Day until the promulgation
     * of the Constitution of Kenya in August 2010.
     *
     * @see https://en.wikipedia.org/wiki/Mashujaa_Day
     *
     * @throws \Exception
     */
    protected function calculateMashujaaDay(): void
    {
        if ($this->year >= 2010) {
            $this->addHoliday(new Holiday(
                'mashujaaDay',
                ['en' => 'Mashujaa Day', 'sw' => 'Siku ya Mashujaa'],
                new \DateTime("{$this->year}-10-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Jamhuri Day.
     *
     * "Siku ya Jamhuri" (Republic Day). Commemorates the day Kenya was
     * admitted into the Commonwealth as a republic on 12 December 1964, and
     * the day Kenya obtained its independence on 12 December 1963.
     *
     * @see https://en.wikipedia.org/wiki/Jamhuri_Day
     *
     * @throws \Exception
     */
    protected function calculateJamhuriDay(): void
    {
        $this->addHoliday(new Holiday(
            'jamhuriDay',
            ['en' => 'Jamhuri Day', 'sw' => 'Siku ya Jamhuri'],
            new \DateTime("{$this->year}-12-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Calculate substitute holidays.
     *
     * Section 4 of the Public Holidays Act (Cap. 110) determines that whenever
     * a public holiday falls on a Sunday, the first succeeding day that is not
     * itself a public holiday shall be a public holiday. For example, when
     * Christmas Day falls on a Sunday, the substitute day is Tuesday 27
     * December, as Monday 26 December is already a public holiday (Boxing Day).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateSubstituteHolidays(): void
    {
        $holidayDates = [];
        foreach ($this->getHolidays() as $holiday) {
            $holidayDates[$holiday->format('Y-m-d')] = true;
        }

        // Loop through all defined holidays
        foreach ($this->getHolidays() as $holiday) {
            if (! $holiday instanceof Holiday) {
                continue;
            }

            // Substitute holiday is only given when the holiday falls on a Sunday
            if (0 !== (int) $holiday->format('w')) {
                continue;
            }

            $date = clone $holiday;
            do {
                $date->add(new \DateInterval('P1D'));
            } while (isset($holidayDates[$date->format('Y-m-d')]));

            $holidayDates[$date->format('Y-m-d')] = true;

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale
            ));
        }
    }
}
