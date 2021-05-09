<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Switzerland.
 */
class Switzerland extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CH';

    /**
     * Initialize holidays for Switzerland.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Zurich';

        $this->calculateNationalDay();
    }

    /**
     * Berchtoldstag.
     *
     * Berchtoldstag is an Alemannic holiday, known in Switzerland and Liechtenstein. It is near
     * New Year's Day, during the Rauhnächte, in Switzerland nearly always on 2 January,
     * with the status of a public holiday in a number of cantons
     *
     * @see https://en.wikipedia.org/wiki/Berchtoldstag
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function calculateBerchtoldsTag(): void
    {
        $this->addHoliday(new Holiday(
            'berchtoldsTag',
            [
                'de' => 'Berchtoldstag',
                'fr' => 'Jour de la Saint-Berthold',
                'en' => 'Berchtoldstag',
            ],
            new DateTime($this->year.'-01-02', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OTHER
        ));
    }

    /**
     * Federal Day of Thanksgiving, Repentance and Prayer.
     *
     * The Federal Day of Thanksgiving, Repentance and Prayer is a public holiday in Switzerland.
     * It is an interfaith feast observed by Roman Catholic dioceses, the Old Catholic Church,
     * the Jewish congregations and the Reformed church bodies as well as other Christian denominations.
     * The subsequent Monday (Lundi du Jeûne) is a public holiday in the canton of Vaud and Neuchâtel.
     *
     * @see https://en.wikipedia.org/wiki/Federal_Day_of_Thanksgiving,_Repentance_and_Prayer
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function calculateBettagsMontag(): void
    {
        if ($this->year >= 1832) {
            // Find third Sunday of September
            $date = new DateTime('Third Sunday of '.$this->year.'-09', DateTimeZoneFactory::getDateTimeZone($this->timezone));
            // Go to next Thursday
            $date->add(new DateInterval('P1D'));

            $this->addHoliday(new Holiday('bettagsMontag', [
                'fr' => 'Jeûne fédéral',
                'de' => 'Eidgenössischer Dank-, Buss- und Bettag',
                'it' => 'Festa federale di ringraziamento, pentimento e preghiera',
            ], $date, $this->locale, Holiday::TYPE_OTHER));
        }
    }

    /**
     * Swiss National Day.
     *
     * The Swiss National Day is set on 1 August. It has been an official national holiday
     * since 1994 only, although the day had been used for the celebration of the foundation
     * of the Swiss Confederacy for the first time in 1891, and than repeated annually since 1899.
     *
     * @see https://en.wikipedia.org/wiki/Swiss_National_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNationalDay(): void
    {
        $translations = [
            'en' => 'National Day',
            'fr' => 'Jour de la fête nationale',
            'de' => 'Bundesfeiertag',
            'it' => 'Giorno festivo federale',
            'rm' => 'Fiasta naziunala',
        ];
        if ($this->year >= 1994) {
            $this->addHoliday(new Holiday(
                'swissNationalDay',
                $translations,
                new DateTime($this->year.'-08-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OFFICIAL
            ));
        } elseif ($this->year >= 1899 || 1891 === $this->year) {
            $this->addHoliday(new Holiday(
                'swissNationalDay',
                $translations,
                new DateTime($this->year.'-08-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
        }
    }
}
