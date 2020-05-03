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

namespace Yasumi\Provider\Canada;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;

/**
 * Provider for all holidays in Prince Edward Island (Canada).
 *
 * Prince Edward Island is a province of Canada.
 *
 * @link https://en.wikipedia.org/wiki/Prince_Edward_Island
 */
class PrinceEdwardIsland extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-PE';

    /**
     * Initialize holidays for Prince Edward Island (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        
        $this->calculateIslanderDay();
        $this->calculateGoldCupParadeDay();
        $this->calculateVictoriaDay();
    }

    /**
     * Victoria Day.
     *
     * @link https://en.wikipedia.org/wiki/Victoria_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateVictoriaDay(): void
    {
        if ($this->year < 1845) {
            return;
        }

        $this->addHoliday(new Holiday(
            'victoriaDay',
            ['en' => 'Victoria Day', 'fr' => 'Fête de la Reine'],
            new DateTime("last monday front of $this->year-05-25", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Islander Day.
     *
     * @link https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateIslanderDay(): void
    {
        if ($this->year < 2009) {
            return;
        }

        $this->addHoliday(new Holiday(
            'islanderDay',
            ['en' => 'Islander Day'],
            new DateTime("third monday of february $this->year", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Gold Cup Parade Day.
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_Canada#Statutory_holidays
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateGoldCupParadeDay(): void
    {
        if ($this->year < 1962) {
            return;
        }

        $this->addHoliday(new Holiday(
            'goldCupParadeDay',
            ['en' => 'Gold Cup Parade Day'],
            new DateTime("third friday of august $this->year", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
