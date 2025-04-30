<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Canada;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Nunavut (Canada).
 *
 * Nunavut is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Nunavut
 */
class Nunavut extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-NU';

    /**
     * Initialize holidays for Nunavut (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Iqaluit';

        $this->calculateCivicHoliday();
        $this->calculateVictoriaDay();
        $this->calculateNunavutDay();
    }

    /**
     * Nunavut Day – July 9, originated as a paid holiday for Nunavut Tunngavik Incorporated
     * and regional Inuit associations. It became a half-day holiday for government employees
     * in 1999 and a full day in 2001.
     *
     * @see https://en.wikipedia.org/wiki/Nunavut_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateNunavutDay(): void
    {
        if ($this->year < 1999) {
            return;
        }

        $this->addHoliday(new Holiday(
            'nunavutDay',
            ['en' => 'Nunavut Day'],
            new \DateTime("{$this->year}-07-09", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }
}
