<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Switzerland;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Switzerland;

/**
 * Provider for all holidays in Neuchâtel (Switzerland).
 *
 * @see https://en.wikipedia.org/wiki/Canton_of_Neuch%C3%A2tel
 * @see http://rsn.ne.ch/DATA/program/books/RSN2017/20171/htm/94102.htm
 * @see https://www.ne.ch/themes/travail/Pages/jours-feries.aspx
 */
class Neuchatel extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CH-NE';

    /**
     * Initialize holidays for Neuchâtel (Switzerland).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->internationalWorkersDay(
            $this->year,
            $this->timezone,
            $this->locale,
            Holiday::TYPE_OTHER
        ));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        $this->calculateBettagsMontag();
        $this->calculateInstaurationRepublique();

        $newYearsDay = $this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER);
        $this->addHoliday($newYearsDay);
        if ('7' === $newYearsDay->format('N')) {
            // If the New Year's Day is a sunday, the next day is an holiday
            $this->calculateJanuary2nd();
        }

        $christmasDay = $this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER);
        $this->addHoliday($christmasDay);
        if ('7' === $christmasDay->format('N')) {
            // If the Christmas Day is a sunday, the next day is an holiday
            $this->calculateDecember26th();
        }
    }

    /**
     * Instauration de la République.
     *
     * @see https://www.feiertagskalender.ch/feiertag.php?ft_id=11&geo=3056&hl=fr
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateInstaurationRepublique(): void
    {
        if ($this->year > 1848) {
            $this->addHoliday(new Holiday(
                'instaurationRepublique',
                [
                    'fr' => 'Instauration de la République',
                ],
                new \DateTime($this->year.'-03-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OTHER
            ));
        }
    }

    /**
     * January 2nd.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateJanuary2nd(): void
    {
        $this->addHoliday(new Holiday(
            'january2nd',
            [
                'en' => 'January 2nd',
                'fr' => '2 janvier',
            ],
            new \DateTime($this->year.'-01-02', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OTHER
        ));
    }

    /**
     * December 26th.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateDecember26th(): void
    {
        $this->addHoliday(new Holiday(
            'december26th',
            [
                'en' => 'December 26th',
                'fr' => '26 décembre',
            ],
            new \DateTime($this->year.'-12-26', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OTHER
        ));
    }
}
