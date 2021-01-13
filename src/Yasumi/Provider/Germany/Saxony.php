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

namespace Yasumi\Provider\Germany;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Saxony (Germany).
 *
 * The Free State of Saxony (German: Freistaat Sachsen) is a landlocked federal state of Germany, bordering the federal
 * states of Brandenburg, Saxony Anhalt, Thuringia, and Bavaria, as well as the countries of Poland and the Czech
 * Republic. Its capital is Dresden, and its largest city is Leipzig.
 *
 * @see https://en.wikipedia.org/wiki/Saxony
 */
class Saxony extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-SN';

    /**
     * Initialize holidays for Saxony (Germany).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->calculateReformationDay();
        $this->calculateRepentanceAndPrayerDay();
    }

    /**
     * For the German state of Saxony, Reformation Day was celebrated since 1517.
     * Note: In 2017 all German states will celebrate Reformation Day for its 500th anniversary.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateReformationDay(): void
    {
        if ($this->year < 1517) {
            return;
        }

        $this->addHoliday($this->reformationDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * Calculates the Day of repentance and prayer.
     *
     * Buß- und Bettag (Day of repentance and prayer) was a public holiday in Germany and is still a public holiday in
     * Saxony. In Germany, Protestant church bodies of Lutheran, Reformed (Calvinist) and United denominational
     * affiliation celebrate a day of repentance and prayer. It is now celebrated in November on the penultimate
     * Wednesday before the beginning of the Protestant liturgical year on the first Sunday of Advent; in other words,
     * it is the Wednesday that falls between 16th and 22nd November. However, it is not a statutory non-working holiday
     * any more, except in the Free State of Saxony.
     *
     * @see https://en.wikipedia.org/wiki/Bu%C3%9F-_und_Bettag
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateRepentanceAndPrayerDay(): void
    {
        if ($this->year >= 1995) {
            $this->addHoliday(new Holiday(
                'repentanceAndPrayerDay',
                ['de' => 'Buß- und Bettag'],
                new DateTime("next wednesday $this->year-11-15", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OFFICIAL
            ));
        }
    }
}
