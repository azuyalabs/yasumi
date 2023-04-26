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

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Spain.
 */
class Spain extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES';

    /**
     * Initialize holidays for Spain.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Madrid';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->valentinesDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays (common in Spain)
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateNationalDay();
        $this->calculateConstitutionDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Spain',
        ];
    }

    /**
     * National Day.
     *
     * The Fiesta Nacional de España is the national day of Spain. It is held annually on October 12 and is a national
     * holiday. It commemorates the anniversary of Christopher Columbus's first arrival in the Americas, a day also
     * celebrated in other countries. The day was known as Dia de la Hispanidad, emphasizing Spain's connection to the
     * Hispanidad, the international Hispanic community. On November 27, 1981, a royal decree established Día de la
     * Hispanidad as a national holiday.
     *
     * @see https://en.wikipedia.org/wiki/Fiesta_Nacional_de_España
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNationalDay(): void
    {
        if ($this->year >= 1981) {
            $this->addHoliday(new Holiday(
                'nationalDay',
                [
                    'ca' => 'Festa Nacional d’Espanya',
                    'es' => 'Fiesta Nacional de España',
                ],
                new \DateTime("$this->year-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Day of Constitution.
     *
     * Constitution Day (Día de la Constitución) marks the anniversary of a referendum held in Spain on December 6,
     * 1978. In this referendum, a new constitution was approved. This was an important step in Spain's transition to
     * becoming a constitutional monarchy and democracy.
     *
     * @see https://www.timeanddate.com/holidays/spain/constitution-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateConstitutionDay(): void
    {
        if ($this->year >= 1978) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                [
                    'ca' => 'Dia de la Constitució',
                    'es' => 'Día de la Constitución',
                ],
                new \DateTime("$this->year-12-6", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
