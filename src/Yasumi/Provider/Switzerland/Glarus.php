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
 * Provider for all holidays in Glarus (Switzerland).
 *
 * @see https://en.wikipedia.org/wiki/Canton_of_Glarus
 */
class Glarus extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CH-GL';

    /**
     * Initialize holidays for Glarus (Switzerland).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        $this->calculateBerchtoldsTag();
        $this->calculateNafelserFahrt();
    }

    /**
     * Näfelser Fahrt.
     *
     * The Battle of Näfels was fought on 9 April 1388 between Glarus with their allies, the Old Swiss
     * Confederation, and the Habsburgs. In 1389, the first Näfelser Fahrt, a pilgrimage to the site
     * of the battle was held.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_N%C3%A4fels
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNafelserFahrt(): void
    {
        if ($this->year >= 1389) {
            $date = new \DateTime('First Thursday of '.$this->year.'-04', DateTimeZoneFactory::getDateTimeZone($this->timezone));
            $this->addHoliday(new Holiday('nafelserFahrt', [
                'de' => 'Näfelser Fahrt',
            ], $date, $this->locale, Holiday::TYPE_OTHER));
        }
    }
}
