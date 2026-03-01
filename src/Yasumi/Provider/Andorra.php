<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
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
 * Provider for all holidays in Andorra.
 *
 * Andorra observes 14 national public holidays. The official language is Catalan (ca_AD).
 * The Principality of Andorra is a co-principality, with the President of France and
 * the Bishop of Urgell serving as co-princes.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Andorra
 */
class Andorra extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * The year the Constitution of Andorra was signed and came into force.
     */
    public const CONSTITUTION_YEAR = 1993;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AD';

    /**
     * Initialize holidays for Andorra.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Andorra';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));

        // Add Andorra-specific holidays
        $this->calculateCarnival();
        $this->calculateConstitutionDay();
        $this->calculateMeritxellDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Andorra',
            'https://wit.ad/en/calendar-public-holidays-in-andorra/',
        ];
    }

    /**
     * Carnival (Dimarts Gras / Mardi Gras).
     *
     * Carnival in Andorra is celebrated on Shrove Tuesday (Mardi Gras), the day before Ash Wednesday.
     * It falls 47 days before Easter Sunday and is one of the 14 official national public holidays.
     *
     * @see https://en.wikipedia.org/wiki/Carnival
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCarnival(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);
        $date = (clone $easter)->sub(new \DateInterval('P47D'));

        if (! $date instanceof \DateTime) {
            throw new \RuntimeException(sprintf('unable to perform a date subtraction for %s:carnival', self::class));
        }

        $this->addHoliday(new Holiday(
            'carnival',
            [
                'ca' => 'Dimarts Gras',
                'en' => 'Carnival',
                'es' => 'Martes de Carnaval',
            ],
            $date,
            $this->locale
        ));
    }

    /**
     * Constitution Day.
     *
     * Constitution Day (Catalan: Dia de la Constitució) commemorates the signing of the Constitution of Andorra
     * on 14 March 1993. The constitution established Andorra as a parliamentary co-principality. It is celebrated
     * annually on 14 March.
     *
     * @see https://en.wikipedia.org/wiki/Constitution_of_Andorra
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateConstitutionDay(): void
    {
        if ($this->year >= self::CONSTITUTION_YEAR) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                [
                    'ca' => 'Dia de la Constitució',
                    'en' => 'Constitution Day',
                    'es' => 'Día de la Constitución',
                ],
                new \DateTime("{$this->year}-3-14", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Our Lady of Meritxell Day (National Day of Andorra).
     *
     * Our Lady of Meritxell Day (Catalan: Dia de la Mare de Déu de Meritxell) is the National Day of Andorra.
     * It is celebrated on 8 September each year in honour of the Virgin of Meritxell, the patron saint of Andorra.
     * The sanctuary of Our Lady of Meritxell is located in the parish of Canillo.
     *
     * @see https://en.wikipedia.org/wiki/Our_Lady_of_Meritxell
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateMeritxellDay(): void
    {
        $this->addHoliday(new Holiday(
            'meritxellDay',
            [
                'ca' => 'Dia de la Mare de Déu de Meritxell',
                'en' => 'Our Lady of Meritxell Day',
                'es' => 'Día de Nuestra Señora de Meritxell',
            ],
            new \DateTime("{$this->year}-9-8", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
