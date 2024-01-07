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

namespace Yasumi\Provider;

use Yasumi\Holiday;

/**
 * Provider for all holidays in Estonia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class Estonia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const DECLARATION_OF_INDEPENDENCE_YEAR = 1918;

    public const VICTORY_DAY_START_YEAR = 1934;

    public const RESTORATION_OF_INDEPENDENCE_YEAR = 1991;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'EE';

    /**
     * Initialize holidays for Estonia.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Tallinn';

        // Official
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addIndependenceDay();
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addVictoryDay();
        $this->addHoliday($this->stJohnsDay($this->year, $this->timezone, $this->locale));
        $this->addRestorationOfIndependenceDay();
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Estonia',
            'https://et.wikipedia.org/wiki/Eesti_riigip%C3%BChad',
        ];
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addIndependenceDay(): void
    {
        if ($this->year >= self::DECLARATION_OF_INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en' => 'Independence Day',
                'et' => 'Iseseisvuspäev',
            ], new \DateTime("{$this->year}-02-24", new \DateTimeZone($this->timezone))));
        }
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addVictoryDay(): void
    {
        if ($this->year >= self::VICTORY_DAY_START_YEAR) {
            $this->addHoliday(new Holiday('victoryDay', [
                'en' => 'Victory Day',
                'et' => 'Võidupüha',
            ], new \DateTime("{$this->year}-06-23", new \DateTimeZone($this->timezone))));
        }
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addRestorationOfIndependenceDay(): void
    {
        if ($this->year >= self::RESTORATION_OF_INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday('restorationOfIndependenceDay', [
                'en' => 'Day of Restoration of Independence',
                'et' => 'Taasiseseisvumispäev',
            ], new \DateTime("{$this->year}-08-20", new \DateTimeZone($this->timezone))));
        }
    }
}
