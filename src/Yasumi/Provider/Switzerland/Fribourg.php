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
 * Provider for all holidays in Fribourg (Switzerland).
 *
 * @see https://en.wikipedia.org/wiki/Canton_of_Fribourg
 * @see https://www.fr.ch/travail-et-entreprises/employes/jour-ferie-jour-chome-quelle-difference
 */
class Fribourg extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CH-FR';

    /**
     * Initialize holidays for Fribourg (Switzerland).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // For the whole canton
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // For the roman catholic communes
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // For the reformed evangelical communes
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->calculateBerchtoldsTag();
        $this->calculateDecember26th();
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
