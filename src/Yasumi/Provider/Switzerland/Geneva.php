<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
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
 * Provider for all holidays in Geneva (Switzerland).
 *
 * @see https://en.wikipedia.org/wiki/Canton_of_Geneva
 * @see https://www.ge.ch/legislation/rsg/f/s/rsg_j1_45.html
 */
class Geneva extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CH-GE';

    public const JEUNE_GENEVOIS_ESTABLISHMENT_YEAR = 1840;

    /**
     * Initialize holidays for Geneva (Switzerland).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        $this->calculateJeuneGenevois();
        $this->calculateRestaurationGenevoise();
    }

    /**
     * Jeûne genevois.
     *
     * Jeûne genevois (meaning Genevan fast) is a public holiday in the canton of Geneva which occurs
     * on the Thursday following the first Sunday of September. It dates back to the 16th century.
     *
     * @see https://en.wikipedia.org/wiki/Je%C3%BBne_genevois
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateJeuneGenevois(): void
    {
        if (self::JEUNE_GENEVOIS_ESTABLISHMENT_YEAR > $this->year) {
            return;
        }

        // Find first Sunday of September
        $date = new \DateTime('First Sunday of '.$this->year.'-09', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        // Go to next Thursday
        $date->add(new \DateInterval('P4D'));

        $type = Holiday::TYPE_OTHER;
        if ($this->year > 1869 && $this->year < 1966) {
            $type = Holiday::TYPE_OBSERVANCE;
        }

        $this->addHoliday(new Holiday('jeuneGenevois', [
            'fr' => 'Jeûne genevois',
        ], $date, $this->locale, $type));
    }

    /**
     * Restauration de la République.
     *
     * On April 15, 1798, French troops entered Geneva; the annexation of the canton by France would
     * last more than fifteen years, until 1813. On December 30, 1813, the last of Napoleon’s troops
     * left Geneva, and the last French warden departed the next day. On December 31, 1813, the
     * Restoration of the Republic of Geneva was declared.
     *
     * @see https://fr.wikipedia.org/wiki/Restauration_genevoise
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateRestaurationGenevoise(): void
    {
        if ($this->year > 1813) {
            $this->addHoliday(new Holiday(
                'restaurationGenevoise',
                [
                    'fr' => 'Restauration de la République',
                ],
                new \DateTime($this->year.'-12-31', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OTHER
            ));
        }
    }
}
