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

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Denmark.
 */
class Denmark extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DK';

    /**
     * Initialize holidays for Denmark.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Copenhagen';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Denmark)
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
        $this->calculateGreatPrayerDay();

        // Add other holidays
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->newYearsEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->calculateConstitutionDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Denmark',
        ];
    }

    /**
     * Great Prayer Day.
     *
     * Store Bededag, translated literally as Great Prayer Day or more loosely as General Prayer Day, "All Prayers" Day,
     * Great Day of Prayers or Common Prayer Day, is a Danish holiday celebrated on the 4th Friday after Easter. It is a
     * collection of minor Christian holy days consolidated into one day. The day was introduced in the Church of
     * Denmark in 1686 by King Christian V as a consolidation of several minor (or local) Roman Catholic holidays which
     * the Church observed that had survived the Reformation.
     *
     * @see https://en.wikipedia.org/wiki/Store_Bededag
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGreatPrayerDay(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone)->format('Y-m-d');

        if ($this->year < 1686) {
            return;
        }

        if ($this->year >= 2024) {
            return;
        }

        $this->addHoliday(new Holiday(
            'greatPrayerDay',
            ['da' => 'store bededag'],
            new \DateTime("fourth friday {$easter}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Constitution Day.
     *
     * Denmark’s Constitution Day is June 5 and commemorates the signing of Denmark's constitution
     * on June 5 1849, when Denmark peacefully became as a constitutional monarchy.
     *
     * While not a public holiday, some companies and public offices are closed. Traditionally,
     * members of parliament gives political speeches around the country.
     *
     * @see https://en.wikipedia.org/wiki/Constitution_Day_(Denmark)
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateConstitutionDay(): void
    {
        if ($this->year >= 1849) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                ['da' => 'grundlovsdag'],
                new \DateTime("{$this->year}-6-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
        }
    }
}
