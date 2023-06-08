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
 * Provider for all holidays in Norway.
 */
class Norway extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'NO';

    /**
     * Initialize holidays for Norway.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Oslo';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Norway)
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateConstitutionDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Norway',
            'https://no.wikipedia.org/wiki/Helligdager_i_Norge',
        ];
    }

    /**
     * Constitution Day.
     *
     * Norway’s Constitution Day is May 17 and commemorates the signing of Norways's constitution at Eidsvoll on
     * May 17, 1814. It’s usually referred to as Grunnlovsdag(en) ((The) Constitution Day), syttende mai (May 17) or
     * Nasjonaldagen (The National Day) in Norwegian.
     *
     * Norway adopted its constitution on May 16 1814 and it was signed on May 17, 1814, ending almost 100 years of a
     * coalition with Sweden, proceeded by nearly 400 years of Danish rule. The Norwegian Parliament, known as
     * Stortinget, held the first May 17 celebrations in 1836, and since it has been regarded as Norway’s National Day.
     *
     * @see https://en.wikipedia.org/wiki/Norwegian_Constitution_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateConstitutionDay(): void
    {
        if ($this->year >= 1836) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                ['nb' => 'grunnlovsdagen'],
                new \DateTime("$this->year-5-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
